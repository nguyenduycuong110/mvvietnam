<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\Interfaces\PromotionRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
/**
 * Class UserService
 * @package App\Services
 */
class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    protected $model;

    public function __construct(
        Promotion $model
    ){
        $this->model = $model;
    }

    public function findByProduct(array $productId = [])
    {
        $baseQuery = function($joinClause) use ($productId) {
            return $this->model->select(
                'promotions.id as promotion_id',
                'promotions.discountValue',
                'promotions.discountType',
                'promotions.maxDiscountValue',
                'promotions.endDate',
                'products.id as product_id',
                'products.price as product_price'
            )
            ->selectRaw($this->getDiscountCalculationQuery())
            ->when($joinClause, $joinClause)
            ->join('products', 'products.id', '=', function($join) {
            })
            ->where('products.publish', 2)
            ->where('promotions.publish', 2)
            ->whereIn(function($query) {
            }, $productId)
            ->whereDate('promotions.endDate', '>', now())
            ->whereDate('promotions.startDate', '<', now());
        };

        $promotions = $this->findDirectPromotions($productId);
        
        if ($promotions->isEmpty()) {
            $promotions = $this->findCataloguePromotions($productId);
        }

        return $promotions;
    }

    private function findDirectPromotions(array $productId)
    {
        return $this->model->select(
            'promotions.id as promotion_id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
            'promotions.endDate',
            'products.id as product_id',
            'products.price as product_price'
        )
        ->selectRaw($this->getDiscountCalculationQuery())
        ->join('promotion_product_variant as ppv', 'ppv.promotion_id', '=', 'promotions.id')
        ->join('products', 'products.id', '=', 'ppv.product_id')
        ->where('products.publish', 2)
        ->where('promotions.publish', 2)
        ->whereIn('ppv.product_id', $productId)
        ->whereDate('promotions.endDate', '>', now())
        ->whereDate('promotions.startDate', '<', now())
        ->groupBy('ppv.product_id')
        ->get();
    }

    private function findCataloguePromotions(array $productId)
    {
        // 1. Lấy tất cả catalogue_ids của products
        $catalogueIds = DB::table('product_catalogue_product')
            ->whereIn('product_id', $productId)
            ->pluck('product_catalogue_id')
            ->unique()
            ->toArray();

        if (empty($catalogueIds)) {
            return collect();
        }

        // 2. Lấy promotion có model = ProductCatalogue và active
        $activePromotions = $this->model
            ->where('promotions.publish', 2)
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(promotions.discountInformation, '$.info.model')) = ?", ['ProductCatalogue'])
            ->whereDate('promotions.endDate', '>', now())
            ->whereDate('promotions.startDate', '<', now())
            ->get();

        // 3. Filter chỉ lấy catalogue_ids có trong promotion JSON
        $validCatalogueIds = [];
        foreach ($activePromotions as $promotion) {
            // discountInformation đã là array
            $discountInfo = $promotion->discountInformation;
            $jsonCatalogueIds = $discountInfo['info']['object']['id'] ?? [];
            
            // Chỉ lấy những catalogue_id vừa có trong products vừa có trong JSON
            foreach ($catalogueIds as $catalogueId) {
                if (in_array((string)$catalogueId, $jsonCatalogueIds)) {
                    $validCatalogueIds[] = $catalogueId;
                }
            }
        }

        $validCatalogueIds = array_unique($validCatalogueIds);

        if (empty($validCatalogueIds)) {
            return collect();
        }

        // 4. Query chỉ với valid catalogue_ids
        return $this->model->select(
            'promotions.id as promotion_id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
            'promotions.endDate',
            'products.id as product_id',
            'products.price as product_price'
        )
        ->selectRaw($this->getDiscountCalculationQuery())
        ->join('product_catalogue_product as pcp', function($join) use ($productId, $validCatalogueIds) {
            $join->whereIn('pcp.product_id', $productId)
                ->whereIn('pcp.product_catalogue_id', $validCatalogueIds);
        })
        ->join('products', 'products.id', '=', 'pcp.product_id')
        ->where('products.publish', 2)
        ->where('promotions.publish', 2)
        ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(promotions.discountInformation, '$.info.model')) = ?", ['ProductCatalogue'])
        ->where(function($query) use ($validCatalogueIds) {
            foreach ($validCatalogueIds as $catalogueId) {
                $query->orWhereRaw("JSON_CONTAINS(JSON_EXTRACT(promotions.discountInformation, '$.info.object.id'), ?)", ['"'.$catalogueId.'"']);
            }
        })
        ->whereDate('promotions.endDate', '>', now())
        ->whereDate('promotions.startDate', '<', now())
        ->groupBy('pcp.product_id')
        ->get();
    }


    private function getDiscountCalculationQuery()
    {
        return "
            MAX(
                IF(promotions.maxDiscountValue != 0,
                    LEAST(
                        CASE 
                            WHEN promotions.discountType = 'cash' THEN promotions.discountValue
                            WHEN promotions.discountType = 'percent' THEN products.price * promotions.discountValue / 100
                            ELSE 0
                        END,
                        promotions.maxDiscountValue
                    ),
                    CASE 
                        WHEN promotions.discountType = 'cash' THEN promotions.discountValue
                        WHEN promotions.discountType = 'percent' THEN products.price * promotions.discountValue / 100
                        ELSE 0
                    END
                )
            ) as discount
        ";
    }


    public function findPromotionByVariantUuid($uuid = ''){
        return $this->model->select(
            'promotions.id as promotion_id',
            'promotions.discountValue',
            'promotions.discountType',
            'promotions.maxDiscountValue',
        )
        ->selectRaw(
            "
                MAX(
                    IF(promotions.maxDiscountValue != 0,
                        LEAST(
                            CASE 
                                WHEN discountType = 'cash' THEN discountValue
                                WHEN discountType = 'percent' THEN pv.price * discountValue / 100
                            ELSE 0
                            END,
                            promotions.maxDiscountValue 
                        ),
                        CASE 
                                WHEN discountType = 'cash' THEN discountValue
                                WHEN discountType = 'percent' THEN pv.price * discountValue / 100
                        ELSE 0
                        END
                    )
                ) as discount
            "
        )
        ->join('promotion_product_variant as ppv', 'ppv.promotion_id', '=', 'promotions.id')
        ->join('product_variants as pv', 'pv.uuid', '=', 'ppv.variant_uuid')
        ->where('promotions.publish', 2)
        ->where('ppv.variant_uuid', $uuid)
        ->whereDate('promotions.endDate', '>', now())
        ->whereDate('promotions.startDate', '<', now())
        ->orderByDesc('discount') 
        ->first();
    }

    public function getPromotionByCartTotal()
    {
        return $this->model
            ->where('promotions.publish', 2)
            ->where('promotions.method', 'order_amount_range')
            ->whereDate('promotions.endDate', '>=', now())
            ->whereDate('promotions.startDate', '<=', now())
            ->get();
    }
    
    public function getPromotionTakeGiftBuyProduct($method, $id = null){
        $promotionIds = $this->model->join('promotion_rules as tb2', 'tb2.promotion_id', '=', 'promotions.id')
        ->where('tb2.product_id', $id)
        ->pluck('promotions.id');
        return $this->model->select(
            'promotions.*',
            'tb4.product_id as pd_id',
            'tb4.name as pd_name',
            'tb4.canonical as pd_canonical',
            'tb2.quantity as pd_quantity',
            'tb7.product_id as pdg_id',
            'tb7.name as pdg_name',
            'tb7.canonical as pdg_canonical',
            'tb5.quantity as pdg_quantity',
        )
        ->leftJoin('promotion_rules as tb2', 'tb2.promotion_id', '=', 'promotions.id')
        ->leftJoin('products as tb3', 'tb3.id', '=', 'tb2.product_id')
        ->leftJoin('product_language as tb4', 'tb4.product_id', '=', 'tb3.id')
        ->leftJoin('promotion_gifts as tb5', 'tb5.promotion_id', '=', 'promotions.id')
        ->leftJoin('products as tb6', 'tb6.id', '=', 'tb5.product_id')
        ->leftJoin('product_language as tb7', 'tb7.product_id', '=', 'tb6.id')
        ->where('promotions.method', $method)
        ->whereIn('promotions.id', $promotionIds)
        ->get();
    }

    
}

