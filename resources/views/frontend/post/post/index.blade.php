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
                                    {!! $post->languages->first()->pivot->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
