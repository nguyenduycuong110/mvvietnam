<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Services\Interfaces\WidgetServiceInterface as WidgetService;
use App\Services\Interfaces\SlideServiceInterface as SlideService;
use App\Models\System;
use App\Enums\SlideEnum;
use Jenssegers\Agent\Facades\Agent;

class PostCatalogueController extends FrontendController
{
    protected $language;
    protected $system;
    protected $postCatalogueRepository;
    protected $postCatalogueService;
    protected $postService;
    protected $widgetService;
    protected $slideService;

    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
        PostCatalogueService $postCatalogueService,
        PostService $postService,
        WidgetService $widgetService,
        SlideService $slideService,
    ) {
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postCatalogueService = $postCatalogueService;
        $this->postService = $postService;
        $this->widgetService = $widgetService;
        $this->slideService = $slideService;
        parent::__construct();
    }


    public function index($id, $request, $page = 1)
    {
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($id, $this->language);
        $postCatalogue->children = $this->postCatalogueRepository->findByCondition(
            [
                ['publish', '=', 2],
                ['parent_id', '=', $postCatalogue->id]
            ],
            true,
            [],
            ['order', 'desc']
        );
        

        $breadcrumb = $this->postCatalogueRepository->breadcrumb($postCatalogue, $this->language);
        $posts = $this->postService->paginate(
            $request,
            $this->language,
            $postCatalogue,
            $page,
            ['path' => $postCatalogue->canonical],
        );

        $widgets = $this->widgetService->getWidget([
            ['keyword' => 'news', 'object' => true],
            ['keyword' => 'news-outstanding', 'object' => true],
            ['keyword' => 'mobile-video', 'object' => true],
            ['keyword' => 'projects-feature', 'object' => true],
            ['keyword' => 'design_construction_interior', 'object' => true],
            ['keyword' => 'showroom-system', 'object' => true],
            ['keyword' => 'customer-banner', 'object' => true],
            ['keyword' => 'video', 'object' => true],
        ], $this->language);

        $slides = $this->slideService->getSlide(
            [SlideEnum::BANNER, SlideEnum::MAIN, 'background-banner'],
            $this->language
        );

        $template = '';
        if (Agent::isMobile() && $postCatalogue->canonical == 'video') {
            
        } else if (Agent::isMobile() && $postCatalogue->canonical == 'du-an') {
            $template = 'mobile.post.catalogue.project';
        } else if ($postCatalogue->canonical == 'du-an') {
           
        } else if ($postCatalogue->canonical == 'video') {
            $template = 'frontend.post.catalogue.video';
        } else if (Agent::isMobile() && ($postCatalogue->canonical == 'thiet-ke-noi-that' || $postCatalogue->canonical == 'thi-cong-noi-that' || $postCatalogue->canonical == 'san-xuat-theo-yeu-cau')) {
            $template = 'mobile.post.catalogue.design';
        } else if (
            Agent::isMobile() && in_array($postCatalogue->canonical, [
                've-chung-toi',
                'doi-tac',
                'bao-hanh-doi-tra',
                'van-chuyen-giao-hang',
                'quy-trinh-lam-viec',
                'hinh-thuc-thanh-toan',
                'bao-gia',
                'lien-he'
            ])
        ) {
            $template = 'mobile.post.catalogue.about-us';
        } else if (
            in_array($postCatalogue->canonical, [
                've-chung-toi',
                'doi-tac',
                'bao-hanh-doi-tra',
                'van-chuyen-giao-hang',
                'quy-trinh-lam-viec',
                'hinh-thuc-thanh-toan',
                'bao-gia',
                'lien-he'
            ])
        ) {
            $template = 'frontend.post.catalogue.about-us';
        } else if (Agent::isMobile()) {
            $template = 'mobile.post.catalogue.index';
        } else {
           
        }

        
       
        
        if($postCatalogue->canonical === 'video'){
            $template = 'frontend.post.catalogue.video';
        }else if($postCatalogue->canonical === 'du-an'){
            $template = 'frontend.post.catalogue.project';
        }else if($postCatalogue->canonical === 'catalogue'){
            $template = 'frontend.post.catalogue.catalogue';
        }else{
            $template = 'frontend.post.catalogue.index';
        }


        $config = $this->config();
        $system = $this->system;
        $seo = seo($postCatalogue, $page);

        $schema = $this->schema($postCatalogue, $posts, $breadcrumb);
        return view($template, compact(
            'config',
            'seo',
            'system',
            'breadcrumb',
            'postCatalogue',
            'posts',
            'widgets',
            'schema',
            'slides'
        ));
    }

    private function schema($postCatalogue, $posts, $breadcrumb)
    {

        $cat_name = $postCatalogue->languages->first()->pivot->name;

        $cat_canonical = write_url($postCatalogue->languages->first()->pivot->canonical);

        $cat_description = strip_tags($postCatalogue->languages->first()->pivot->description);

        $itemListElements = '';

        $position = 1;

        foreach ($posts as $post) {
            $name = $post->languages->first()->pivot->name;
            $canonical = write_url($post->languages->first()->pivot->canonical);
            $itemListElements .= "
                {
                    \"@type\": \"BlogPosting\",
                    \"headline\": \" " . $name . " \",
                    \"url\": \" " . $canonical . " \",
                    \"datePublished\": \" " . convertDateTime($post->created_at, 'd-m-Y') . " \",
                    \"author\": {
                        \"@type\": \" Person  \",
                        \"name\": \" An Hưng \",
                    }
                },";
            $position++;
        }

        $itemListElements = rtrim($itemListElements, ',');

        $itemBreadcrumbElements = '';

        $positionBreadcrumb = 2;

        foreach ($breadcrumb as $key => $item) {
            $name = $item->languages->first()->pivot->name;
            $canonical = write_url($item->languages->first()->pivot->canonical);
            $itemBreadcrumbElements .= "
                {
                    \"@type\": \"ListItem\",
                    \"position\": $positionBreadcrumb,
                    \"name\": \"" . $name . "\",
                    \"item\": \"" . $canonical . "\",
                },";
            $positionBreadcrumb++;
        }

        $itemBreadcrumbElements = rtrim($itemBreadcrumbElements, ',');

        $schema = "<script type='application/ld+json'>
            {
                \"@type\": \"BreadcrumbList\",
                \"itemListElement\": [
                    {
                        \"@type\": \"ListItem\",
                        \"position\": 1,
                        \"name\": \" Trang chủ  \",
                        \"item\": \" " . config('app.url') . " \"
                    },
                    $itemBreadcrumbElements
                ]
            },
            {
                \"@context\": \"https://schema.org\",
                \"@type\": \"Blog\",
                \"name\": \"" . $cat_name . "\",
                \"description\": \" " . $cat_description . " \",
                \"url\": \"" . $cat_canonical . "\",
                \"publisher\": [
                    \"@type\": \"Organization\",
                    \"name\": \" An Hưng \",
                ],
                \"blogPost\": {
                    $itemListElements
                }
            }
            </script>";
        return $schema;
    }


    private function config()
    {
        return [
            'language' => $this->language,
            'css' => [
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css',
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css',
                'frontend/resources/css/custom.css'
            ],
            'js' => [
                'frontend/resources/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js',
                'frontend/resources/library/js/carousel.js',
                'https://getuikit.com/v2/src/js/components/sticky.js'
            ]
        ];
    }

}