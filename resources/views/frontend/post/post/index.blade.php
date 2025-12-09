@extends('frontend.homepage.layout')
@section('content')
@php
    $breadcrumbImage = !empty($postCatalogue->album) ? json_decode($postCatalogue->album, true)[0] : asset('userfiles/image/system/breadcrumb.png');
@endphp
<div class="post-detail">
    @include('frontend.component.breadcrumb', [
        'model' => $post,
        'breadcrumb' => $breadcrumb,
    ])
    <div class="product-catalogue-wrapper post-container">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-large-3-4">
                    <div class="wrapper">
                        <div class="panel-head">
                            <h1 class="page-heading">{{ $post->languages->first()->pivot->name }}</h1>
                            <div class="time">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.80657 0.55838C10.9552 0.55838 13.0159 1.41193 14.5352 2.93125C16.0545 4.45058 16.9081 6.51122 16.9081 8.65987C16.9081 10.8085 16.0545 12.8692 14.5352 14.3885C13.0159 15.9078 10.9552 16.7614 8.80657 16.7614C6.65792 16.7614 4.59727 15.9078 3.07795 14.3885C1.55863 12.8692 0.705078 10.8085 0.705078 8.65987C0.705078 6.51122 1.55863 4.45058 3.07795 2.93125C4.59727 1.41193 6.65792 0.55838 8.80657 0.55838ZM8.80657 1.41117C6.88409 1.41117 5.04036 2.17487 3.68096 3.53427C2.32157 4.89366 1.55787 6.7374 1.55787 8.65987C1.55787 10.5823 2.32157 12.4261 3.68096 13.7855C5.04036 15.1449 6.88409 15.9086 8.80657 15.9086C9.75848 15.9086 10.7011 15.7211 11.5805 15.3568C12.46 14.9925 13.2591 14.4586 13.9322 13.7855C14.6053 13.1124 15.1392 12.3133 15.5035 11.4338C15.8678 10.5544 16.0553 9.61178 16.0553 8.65987C16.0553 6.7374 15.2916 4.89366 13.9322 3.53427C12.5728 2.17487 10.729 1.41117 8.80657 1.41117ZM8.38018 3.96953H9.23296V8.59165L13.2411 10.9027L12.8147 11.6446L8.38018 9.08627V3.96953Z" fill="#FFA629"/>
                                </svg>
                                {{ $post->created_at }}
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="uk-container uk-container-center" style="padding-top:20px;padding-bottom:30px;">
                                <div class="post-detail-container">
                                    <div class="post-content {{ $post->status_menu == 2 ? 'full' : '' }}">
                                        <div class="content">
                                            <x-table-of-contents :content="$contentWithToc" />
                                            {!! $contentWithToc !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($relatedPosts) && count($relatedPosts) > 0)
                    <div class="post-related mt30 mb30" style="margin-top: 40px; margin-bottom: 40px;">
                        <div class="panel-product">
                            <div class="main-heading">
                                <div class="panel-head">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <h2 class="heading-2" style="text-transform:uppercase; margin-bottom: 20px;"><span>Bài viết liên quan</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body list-post" style="padding-top: 20px;">
                                <div class="post-related-wrapper uk-grid uk-grid-medium uk-grid-match" data-uk-grid>
                                    @foreach($relatedPosts as $index => $relatedPost)
                                        <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3" style="margin-bottom: 30px;">
                                            @include('frontend.component.post-item', ['post' => $relatedPost])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="uk-width-large-1-4">
                    <div class="post-aside">
                        <div class="aside-form panel-contact aside-panel">
                            <div class="aside-heading">Đăng ký tư vấn</div>
                            <div class="aside-body">
                                <form action="" method="POST" class="register-form">
                                    <div class="form-group" bis_skin_checked="1">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" name="email" value="" class="form-input" id="reg_email" placeholder="Nhập vào email của bạn *" required="">
                                    </div>
                                    <div class="form-group" bis_skin_checked="1">
                                        <label class="form-label" for="name">Họ tên</label>
                                        <input type="text" name="name" value="" class="form-input" id="reg_name" placeholder="Nhập vào họ tên của bạn *" required="">
                                    </div>
                                    <div class="form-group" bis_skin_checked="1">
                                        <label class="form-label" for="phone">Số điện thoại</label>
                                        <input type="text" name="phone" value="" class="form-input" id="reg_phone" placeholder="Nhập vào số điện thoại của bạn *" required="">
                                    </div>
                                    <div class="form-group" bis_skin_checked="1">
                                        <label class="form-label" for="product_id">Khóa học quan tâm</label>
                                        <input type="text" name="product_id" value="" class="form-input" id="reg_product_name" placeholder="Nhập vào tên khóa học bạn quan tâm *" required="">
                                    </div>
                                    <div class="form-group" bis_skin_checked="1">
                                        <label class="form-label" for="message">Lời nhắn</label>
                                        <textarea name="message" class="form-input" id="reg_message" cols="30" rows="10" placeholder="Lời nhắn của bạn *"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="register-btn" id="">
                                        Đăng ký ngay
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if(count($widgets['product-catalogue']->object))
                       
                        <div class="aside-product-category aside-panel">
                            <div class="aside-heading">Danh mục khóa học</div>
                            <div class="aside-body">
                                @foreach($widgets['product-catalogue']->object as $key => $val)
                                @php
                                    $image = $val->image;
                                    $name = $val->languages->name;
                                    $canonical = write_url($val->languages->canonical);
                                    $description = $val->languages->description;
                                @endphp
                                <div class="category-item uk-flex uk-flex-middle">
                                    <span class="icon"><img src="{{ $image }}" alt="{{ $name }}"></span>
                                    <a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                         @endif
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
