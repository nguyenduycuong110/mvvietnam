<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\Interfaces\WidgetServiceInterface  as WidgetService;
use Jenssegers\Agent\Facades\Agent;
use App\Models\Post;
use App\View\Components\TableOfContents;

class postController extends FrontendController
{
    protected $language;
    protected $system;
    protected $postCatalogueRepository;
    protected $postCatalogueService;
    protected $postService;
    protected $postRepository;
    protected $widgetService;

    public function __construct(
        PostCatalogueRepository $postCatalogueRepository,
        PostCatalogueService $postCatalogueService,
        PostService $postService,
        PostRepository $postRepository,
        WidgetService $widgetService,
    ){
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->postCatalogueService = $postCatalogueService;
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->widgetService = $widgetService;
        parent::__construct(); 
    }


    public function index($id, $request){
        $language = $this->language;
        $post = $this->postRepository->getPostById($id, $this->language, config('apps.general.defaultPublish'));
        $viewed = $post->viewed;
        $updateViewed = Post::where('id', $id)->update(['viewed' => $viewed + 1]); 
        if(is_null($post)){
            abort(404);
        }
        $postCatalogue = $this->postCatalogueRepository->getPostCatalogueById($post->post_catalogue_id, $this->language);
        if($postCatalogue->id == 22 || $postCatalogue->id == 24 || $postCatalogue->id === 44){
            $postCatalogue->children = $this->postCatalogueRepository->findByCondition(
                [
                    ['publish' , '=', 2],
                    ['parent_id', '=', 21]
                ],
                true,
                [],
                ['order', 'desc']
            );
        }

        // dd(123);

        $breadcrumb = $this->postCatalogueRepository->breadcrumb($postCatalogue, $this->language);

        $asidePost = $this->postService->paginate(
            $request, 
            $this->language, 
            $postCatalogue, 
            1,
            ['path' => $postCatalogue->canonical],
        );


        $widgets = $this->widgetService->getWidget([
            ['keyword' => 'product-catalogue', 'object' => true],
            
        ], $this->language);

        /* ------------------- */
        
        $config = $this->config();
        $system = $this->system;
        $seo = seo($post);
        


        $template = 'frontend.post.post.index';

        $schema = $this->schema($post, $postCatalogue, $breadcrumb);
        $content = $post->languages->first()->pivot->content;
        // dd($content);
        // dd($content, $cont);
        $items = TableOfContents::extract($content);
        $contentWithToc = null;
        $contentWithToc = TableOfContents::injectIds($content, $items);
        // dd($contentWithToc);

        return view($template, compact(
            'config',
            'seo',
            'system',
            'breadcrumb',
            'postCatalogue',
            'post',
            'asidePost',
            'widgets',
            'schema',
            'contentWithToc'
        ));
    }

    private function schema($post, $postCatalogue, $breadcrumb)
    {
        $image = $post->image;
        $name = $post->languages->first()->pivot->name;
        $description = strip_tags($post->languages->first()->pivot->description);
        $canonical = write_url($post->languages->first()->pivot->canonical);

        /* ---------------- BREADCRUMB ---------------- */
        $breadcrumbItems = [];
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 1,
            "name" => "Trang chủ",
            "item" => config('app.url')
        ];

        $pos = 2;
        foreach ($breadcrumb as $item) {
            $breadcrumbItems[] = [
                "@type" => "ListItem",
                "position" => $pos,
                "name" => $item->languages->first()->pivot->name,
                "item" => write_url($item->languages->first()->pivot->canonical)
            ];
            $pos++;
        }

        $breadcrumbSchema = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $breadcrumbItems
        ];

        /* ---------------- BLOG POSTING ---------------- */
        $blogSchema = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $name,
            "description" => $description,
            "image" => $image,
            "url" => $canonical,
           "datePublished" => optional($post->created_at)->toIso8601String(),
            "dateModified" => optional($post->updated_at ?? $post->created_at)->toIso8601String(),
            "author" => [
                "@type" => "Person",
                "name" => "Tác giả"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "An Hưng",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => config('app.url') . "/logo.png"
                ]
            ],
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => $canonical
            ],
            "articleSection" => $postCatalogue->languages->first()->pivot->name,
            "keywords" => "",
        ];

        $schemas = json_encode([$breadcrumbSchema, $blogSchema], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return "<script type=\"application/ld+json\">$schemas</script>";
    }

    private function config(){
        return [
            'language' => $this->language,
            'js' => [
                'frontend/core/library/cart.js',
                'frontend/core/library/product.js',
                'frontend/core/library/review.js',
                'https://prohousevn.com/scripts/fancybox-3/dist/jquery.fancybox.min.js'
            ],
            'css' => [
                'frontend/core/css/product.css',
                'https://prohousevn.com/scripts/fancybox-3/dist/jquery.fancybox.min.css'
            ]
        ];
    }

}
