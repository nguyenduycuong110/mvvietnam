@extends('frontend.homepage.layout')
@section('content')
    <div id="homepage" class="homepage">
        @include('frontend.component.slide')
        @if(isset($widgets['product-catalogue']) && !is_null($widgets['product-catalogue']))
            <div class="panel-product-catalogue">
                <div class="bg-overlay">
                    <img src="/frontend/resources/img/curve.svg" alt="">
                </div>
                <div class="uk-container uk-container-center">
                    <div class="uk-grid uk-grid-medium">
                        @if(count($widgets['product-catalogue']->object))
                            @php
                                $time = 1;
                            @endphp
                            @foreach($widgets['product-catalogue']->object as $key => $val)
                                <div class="uk-width-large-1-4">
                                    @php
                                        $image = $val->image;
                                        $name = $val->languages->name;
                                        $canonical = write_url($val->languages->canonical);
                                        $description = $val->languages->description;
                                    @endphp
                                    <a href="{{ $canonical }}" title="{{ $name }}" class="product-catalogue-item wow fadeInDown" data-wow-delay="{{ $time.($key + 1)  }}">
                                        <div class="image img-scaledown">
                                            <svg width="67" height="53" viewBox="0 0 67 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M62.8066 43.5603C54.2873 57.8238 38.5296 52.327 22.6027 46.6765C6.67581 41.026 -5.75126 31.8179 2.76806 17.5545C11.2874 3.29098 31.0886 -3.68761 47.0094 1.95785C62.9302 7.60332 71.29 29.3381 62.7779 43.5933L62.8066 43.5603Z" fill="#5F2DED" fill-opacity="0.05"/>
                                            </svg>
                                            <img src="{{ $image }}" alt="">
                                        </div>
                                        <div class="text-content">
                                            <h4 class="heading-3">
                                                <span>{{ $name }}</span>
                                            </h4>
                                            <div class="description">
                                                {!! $description !!}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if(isset($widgets['best-selling-course']) && !is_null($widgets['best-selling-course']))
            <div class="panel-bs-courses">
                <div class="uk-container uk-container-center">
                    <div class="panel-head">
                        @php
                            $description_wg = reset($widgets['best-selling-course']->description);
                            $name_wg = $widgets['best-selling-course']->name;
                        @endphp
                        <div class="bagde wow fadeInDown" data-wow-delay="1">
                            {!! $description_wg !!}
                        </div>
                        <h3 class="heading-2 wow fadeIn" data-wow-delay="1.2"><span>{{ $name_wg }}</span></h3>
                    </div>
                    @if(count($widgets['best-selling-course']->object))
                        @php
                            $time = 1.5;
                        @endphp
                        <div class="panel-body">
                            <div class="uk-grid uk-grid-medium">
                                @foreach($widgets['best-selling-course']->object as $key => $val)
                                    <div class="uk-width-medium-1-4 wow fadeInDown" data-wow-delay="{{ $time.($key + 1)  }}">
                                        @include('frontend.component.product-item', ['product' => $val])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="btn">
                        <a href="{{ write_url('san-pham') }}" title="" class="btn-rm">Xem thêm</a>
                    </div>
                </div>
            </div>
        @endif
        @if(isset($widgets['new-course-launch']) && !is_null($widgets['new-course-launch']))
            <div class="panel-new-course">
                <div class="uk-container uk-container-center">
                    <div class="panel-head">
                        @php
                            $description_wg = reset($widgets['new-course-launch']->description);
                            $name_wg = $widgets['new-course-launch']->name;
                        @endphp
                        <div class="uk-grid uk-grid-medium">
                            <div class="uk-width-medium-1-2">
                                <div class="title">
                                     <div class="bagde wow fadeInDown" data-wow-delay="1">
                                        {!! $description_wg !!}
                                    </div>
                                    <h3 class="heading-2 wow fadeIn" data-wow-delay="1.2"><span>{{ $name_wg }}</span></h3>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                @if(count($widgets['new-course-launch']->object))
                                    <div class="filter-category">
                                        <ul class="uk-list uk-clearfix uk-flex uk-flex-middle">
                                            <li class="active all">
                                                <span>Tất cả</span>
                                            </li>
                                            @foreach($widgets['new-course-launch']->object as $key => $val)
                                                @php
                                                    $ct_id = $val->Product_catalogues[0]->id;
                                                    $ct_name = $val->Product_catalogues[0]->languages->name;
                                                @endphp
                                                <li data-product-catalogue-id="{{ $ct_id }}"><span>{{ $ct_name }}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(count($widgets['new-course-launch']->object))
                        @php
                            $time = 2;
                        @endphp
                        <div class="panel-body all-pd">
                            <div class="uk-grid uk-grid-medium">
                                @foreach($widgets['new-course-launch']->object as $k => $product)
                                    <div class="uk-width-medium-1-4 wow fadeInDown" data-wow-delay="{{ $time.($k + 1)  }}">
                                        @include('frontend.component.product-item',['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="btn">
                        <a href="{{ write_url('san-pham') }}" title="" class="btn-rm">Xem thêm</a>
                    </div>
                </div>
            </div>
        @endif
        <div class="panel-contact">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-medium-2-3">
                        <div class="left-section">
                            <div class="image-content">
                                <img src="/frontend/resources/img/register_1.svg" alt="">
                            </div>
                            <div class="text-content">
                                <div class="badge wow fadeInUp" data-wow-delay="0.2s">
                                    <span>Đăng ký khóa học</span>
                                </div>
                                <h3 class="heading-2 wow fadeInUp" data-wow-delay="0.3s">
                                    ĐĂNG KÝ TÀI KHOẢN ĐỂ NHẬN NGAY<br>
                                    CÁC CHƯƠNG TRÌNH <span class="highlight">ƯU ĐÃI</span> MỚI<br>
                                    NHẤT
                                </h3>
                                <div class="contact-info  wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="phone-icon">
                                        <img src="/frontend/resources/img/call.svg" alt="">
                                    </div>
                                    <div class="phone-info">
                                        <div class="phone-label">Hoặc gọi trực tiếp</div>
                                        <a href="tel:{{ $system['contact_hotline'] }}" class="phone-number">{{ $system['contact_hotline'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <div class="right-section wow fadeInUp" data-wow-delay="0.3s">
                            <h4 class="heading-3"><span>Đăng ký</span></h4>
                            <form action="" method="POST" class="register-form">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email" value="" class="form-input" id="email" placeholder="Nhập vào email của bạn *" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Họ tên</label>
                                    <input type="text" name="name" value="" class="form-input" id="name" placeholder="Nhập vào họ tên của bạn *" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" value="" class="form-input" id="phone" placeholder="Nhập vào số điện thoại của bạn *" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="product_id">Khóa học quan tâm</label>
                                    <input type="text" name="product_id" value="" class="form-input" id="product_id" placeholder="Nhập vào tên khóa học bạn quan tâm *" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="message">Lời nhắn</label>
                                    <textarea name="message" class="form-input" id="message" cols="30" rows="10" placeholder="Lời nhắn của bạn *"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="captcha">Mã xác thực</label>
                                    <div class="captcha-container">
                                        <input type="text" name="captcha" class="form-input captcha-input" id="captcha" placeholder="Nhập mã xác thực" required>
                                        <div class="captcha-display captcha-tooltip" id="captchaDisplay" title="Click để làm mới mã">
                                            397x67.93<span class="refresh-icon">🔄</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="register-btn" id="">
                                    Đăng ký ngay
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/frontend/resources/img/register_3.svg" alt="" class="register_3">
        </div>
        @php
            $slideKeyword = App\Enums\SlideEnum::TECHSTAFF;
        @endphp
        @if(count($slides[$slideKeyword]['item']))
            <div class="panel-tech-staff">
                <div class="uk-container uk-container-center">
                    <div class="panel-head">
                        <div class="badge wow fadeInUp" data-wow-delay="0.1s">
                            <span>Giảng Viên</span>
                        </div>
                        <h3 class="heading-2 wow fadeInUp" data-wow-delay="0.15s"><span>{!! $slides[$slideKeyword]['name'] !!}</span></h3>
                        <div class="description wow fadeInUp" data-wow-delay="0.2s">
                            {{ $slides[$slideKeyword]['short_code'] }}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @php
                                    $time = 0.3;
                                @endphp
                                @foreach($slides[$slideKeyword]['item'] as $key => $val )
                                    <div class="swiper-slide">
                                        <div class="slide-item wow fadeInUp" data-wow-delay="{{ $time * ( $key + 1) }}s">
                                            <div class="image-content">
                                                <img src="{{ $val['image'] }}" alt="">
                                            </div>
                                            <div class="text-content">
                                                <div class="name">{{ $val['name'] }}</div>
                                                <div class="description">{{ $val['alt'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev wow fadeInUp" data-wow-delay="0.2s">
                                <img src="/frontend/resources/img/prev.svg" alt="">
                            </div>
                            <div class="swiper-button-next wow fadeInUp" data-wow-delay="0.2s">
                                <img src="/frontend/resources/img/next.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="panel-news-video">
            <div class="uk-container uk-container-center">
                <div class="wrapper">
                    <div class="uk-grid uk-grid-medium">
                        @if(isset($widgets['news']) && !is_null($widgets['news']))
                            <div class="uk-width-medium-2-3">
                                @php
                                    $ct_name = $widgets['news']->name;
                                @endphp
                                <div class="news">
                                    <div class="panel-head">
                                        <h3 class="heading-2 wow fadeInUp" data-wow-delay="0.1s">
                                            <span>{{ $ct_name }}</span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="uk-grid uk-grid-medium">
                                            <div class="uk-width-medium-1-2">
                                                @if(count($widgets['news']->object))
                                                    @foreach($widgets['news']->object as $key => $val)
                                                        @if($key == 0)
                                                            @php
                                                                $image = $val->image;
                                                                $name = $val->languages->name;
                                                                $canonical = write_url($val->languages->canonical);
                                                                $description = $val->languages->description;
                                                                $time_post = $val->created_at;
                                                            @endphp
                                                            <a href="{{ $canonical }}" title="" class="latest-news bl wow fadeInUp" data-wow-delay="0.2s">
                                                                <div class="image img-cover img-zoomin">
                                                                    <img src="{{ $image }}" alt="">
                                                                </div>
                                                                <div class="name">{{ $name }}</div>
                                                                <div class="time-post">
                                                                    <img src="/frontend/resources/img/time.svg" alt="">
                                                                    <span>{{  $time_post }}</span>
                                                                </div>
                                                                <div class="description">
                                                                    {!! $description !!}
                                                                </div>
                                                                <p class="rm">Đọc tiếp</p>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="uk-width-medium-1-2">
                                                @if(count($widgets['news']->object))
                                                    @php
                                                        $time = 0.2;
                                                    @endphp
                                                    @foreach($widgets['news']->object as $key => $val)
                                                        @if($key > 0 && $key < 5)
                                                            @php
                                                                $image = $val->image;
                                                                $name = $val->languages->name;
                                                                $canonical = write_url($val->languages->canonical);
                                                                $description = $val->languages->description;
                                                                $time_post = $val->created_at;
                                                            @endphp
                                                            <a href="{{ $canonical }}" title="" class="latest-news bl post-item wow fadeInUp" data-wow-delay="{{ $time * ($key + 1)}}s">
                                                                <div class="left">
                                                                    <div class="image img-cover img-zoomin">
                                                                        <img src="{{ $image }}" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="right">
                                                                    <div class="name">{{ $name }}</div>
                                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                        <div class="time-post">
                                                                            <img src="/frontend/resources/img/time.svg" alt="">
                                                                            <span>{{  $time_post }}</span>
                                                                        </div>
                                                                        <p class="rm">Đọc tiếp</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($widgets['videos']) && !is_null($widgets['videos']))
                            <div class="uk-width-medium-1-3">
                                @php
                                    $ct_name = $widgets['videos']->name;
                                @endphp
                                <div class="videos">
                                    <div class="panel-head">
                                        <h3 class="heading-2 wow fadeInUp" data-wow-delay="0.1s">
                                            <span>{{ $ct_name }}</span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        @if(count($widgets['videos']->object))
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    @foreach($widgets['videos']->object as $key => $val)
                                                        <div class="swiper-slide">
                                                            @php
                                                                $image = $val->image;
                                                                $video = $val->video;
                                                            @endphp
                                                            <div class="slide-item">
                                                                <a href="{{ $video }}" class="image img-cover wow fadeInUp" data-wow-delay="0.2s" target="_blank">
                                                                    <img src="{{ $image }}" alt="">
                                                                    <button class="btn-play">
                                                                        <img src="/frontend/resources/img/play.svg" alt="">
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php
            $slideKeyword = App\Enums\SlideEnum::PARTNER;
        @endphp
        @if(count($slides[$slideKeyword]['item']))
            <div class="panel-partner">
                <div class="uk-container uk-container-center">
                    <div class="wrapper">
                        <div class="panel-head">
                            <h3 class="heading-2 wow fadeInDown" data-wow-delay="0.1s">{!! $slides[$slideKeyword]['name'] !!}</span></h3>
                            <div class="description wow fadeInDown" data-wow-delay="0.15s">{{ $slides[$slideKeyword]['short_code'] }}</div>
                        </div>
                        <div class="panel-body">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @php 
                                        $time = 0.2;
                                    @endphp
                                    @foreach($slides[$slideKeyword]['item'] as $key => $val )
                                        <div class="swiper-slide">
                                            <div class="slide-item wow fadeInDown" data-wow-delay="{{ $time * ($key + 1) }}s">
                                                <a href="" class="image img-cover">
                                                    <img src="{{ $val['image'] }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
