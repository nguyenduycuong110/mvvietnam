@extends('frontend.homepage.layout')
@section('content')
    <div class="lecturer-page">
        <div class="uk-container uk-container-center">
            <div class="page-breadcrumb background">      
                <ul class="uk-list uk-clearfix uk-flex uk-flex-middle">
                    <li>
                        <a href="/">{{ __('frontend.home') }}</a>
                    </li>
                    <li>
                        <span class="slash">/</span>
                    </li>
                    <li>
                        <a href="{{ write_url('giao-vien') }}">Giáo viên</a>
                    </li>
                    <li>
                        <span class="slash">/</span>
                    </li>
                    <li><a href="{{ write_url('giao-vien/'. $lecturer->canonical) }}">{{ $lecturer->name }}</a></li>
                </ul>
            </div>
            <div class="uk-grid uk-grid-large">
                <div class="uk-width-large-1-4">
                    @if($allLecturers)
                        <div class="bucket mb20">
                            <div class="filter-item">
                                <div class="filter-item__title filters-title" style="padding-top: 12px;">
                                    <h3 class="heading-2"><span>Giảng viên</span></h3>
                                </div>
                                <div class="filter-item__content filter-group">
                                    <ul class="filter-list">
                                        @foreach($allLecturers as $key => $val)
                                            <li class="filter-list__item">
                                                <a href="{{ write_url('giao-vien/'. $val->canonical ) }}">{{ $val->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="uk-width-large-3-4">
                    <div class="lecturer-info">
                        <div class="uk-grid uk-grid-medium">
                            <div class="uk-width-medium-1-3">
                                <a href="" class="image img-cover">
                                    <img src="{{ $lecturer->image }}" alt="">
                                </a>
                            </div>
                            <div class="uk-width-medium-2-3">
                                <div class="text-content">
                                    <h2 class="heading-1">
                                        <span>{{ $lecturer->name }}</span>
                                    </h2>
                                    <div class="description">
                                        {!! $lecturer->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-courses">
                        <h2 class="heading-1 mb30">
                            <span>Danh sách khóa học của {{ $lecturer->name }}</span>
                        </h2>
                        @if(!empty($products))
                            <div class="uk-grid uk-grid-medium">
                                @foreach ($products as $product)
                                    <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-3 mb25">
                                        @include('frontend.component.p-item', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
