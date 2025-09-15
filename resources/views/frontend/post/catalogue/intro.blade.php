@extends('frontend.homepage.layout')
@php
    $section1 = [
        [
            'number' => $introduce['block_1_number_1'],
            'title' => 'Chuyên Gia'
        ],
        [
            'number' => $introduce['block_1_number_2'],
            'title' => 'Năm Kinh Nghiệm'
        ],
        [
            'number' => $introduce['block_1_number_3'],
            'title' => 'Học viên trên toàn quốc'
        ],
    ];

    $section2 = [
        [
            'icon' => 'frontend/resources/img/intro-icon-1.png',
            'title' => $introduce['block_2_text_1'],
        ],
        [
            'icon' => 'frontend/resources/img/intro-icon-2.png',
            'title' => $introduce['block_2_text_2'],
        ],
        [
            'icon' => 'frontend/resources/img/intro-icon-3.png',
            'title' => $introduce['block_2_text_3'],
        ]
    ];
@endphp
@section('content')
    <div class="intro-container">
        <div class="intro-section-1" style="background:url({{ $introduce['block_1_background'] }})">
            <div class="breadcrumb uk-text-center uk-flex uk-flex-center">
                {{-- <ul class="uk-list uk-clearfix uk-flex uk-flex-middle">
                    <li>
                        <a href="/">{{ __('frontend.home') }}</a>
                    </li>
                    <li>
                        <span class="slash">/</span>
                    </li>
                    @if(!is_null($breadcrumb))
                        @foreach($breadcrumb as $key => $val)
                            @php
                                $name = $val->languages->first()->pivot->name;
                                $canonical = write_url($val->languages->first()->pivot->canonical, true, true);
                            @endphp
                            <li>
                                <a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul> --}}
            </div>
            <div class="section-1-info uk-text-center">
                <h2 class="heading wow fadeInDown" data-wow-duration="1s">{{ $introduce['block_1_title'] }}</h2>
                <div class="description wow fadeInLeft" data-wow-delay="0.3s">{{ $introduce['block_1_description'] }}</div>
                <div class="section-1-list">
                    <div class="uk-grid uk-grid-medium">
                        @php
                            $time = 0.3;
                        @endphp
                        @foreach($section1 as $key => $item)
                            <div class="uk-width-small-1-3 uk-width-medium-1-3 uk-width-large-1-3">
                                <div class="section-1-item uk-text-center wow fadeInRight" data-wow-delay="{{ $time * ($key + 1)}}s">
                                    <div class="number">{{ $item['number'] }}</div>
                                    <div class="title">{{ $item['title'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="button-group">
                    <div class="uk-flex uk-flex-middle uk-flex-center">
                        <a href="{{ $introduce['block_1_button_1_link'] }}" class="button-style-1 wow fadeInLeft" data-wow-delay="0.4s">{{ $introduce['block_1_button_1'] }}</a>
                        <a href="{{ $introduce['block_1_button_2_link'] }}" class="button-style-2 wow fadeInLeft" data-wow-delay="0.5s">{{ $introduce['block_1_button_2'] }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-container uk-container-center">
            <div class="intro-section-2">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-large-2-3">
                        <h2 class="heading wow fadeInDown" data-wow-delay="0.4s">{{ $introduce['block_2_title'] }}</h2>
                        <ul class="uk-list uk-clearfix intro-2-list">
                            @php
                                $time = 0.2;
                            @endphp
                            @foreach($section2 as $k => $item)
                                <li>
                                    <a href="" class="uk-flex uk-flex-middle wow fadeInDown" data-wow-delay="{{ $time * ($k + 1) }}s">
                                        <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }}">
                                        <span>{{ $item['title'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="intro-2-button">
                            <a href="{{ $introduce['block_2_button_link'] }}" class="wow fadeInDown" data-wow-delay="0.4s">{{ $introduce['block_2_button'] }}</a>
                        </div>
                    </div>
                    <div class="uk-width-large-1-3">
                        <img src="{{ $introduce['block_2_image'] }}" alt="2">
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-section-3">
            <div class="uk-container uk-container-center">
                <h2 class="heading wow fadeInDown" data-wow-delay="0.4s">{{ $introduce['block_3_title'] }}</h2>
                <div class="number-line">
                    @php
                        $time = 0.1;
                    @endphp
                    <div class="uk-grid uk-grid-medium">
                        @for($i = 1; $i<=4; $i++)
                            <div class="uk-width-1-4 uk-width-small-1-4 uk-width-large-1-4">
                                <div class="number-item wow fadeInDown" data-wow-delay="{{ $time * ($i + 1) }}s">
                                    <span class="">{{ $i }}</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                @php
                    $time = 0.2;
                @endphp
                <div class="uk-grid uk-grid-medium">
                    @for($i = 1; $i<=4; $i++)
                        <div class="uk-width-small-1-2 uk-width-medium-1-4 uk-width-large-1-4 mb20">
                            <div class="section-3-item wow fadeInDown" data-wow-delay="{{ $time * ($i + 1) }}s">
                                <div class="title">{{ $introduce['block_3_text_'.$i] }}</div>
                                <div class="description">{{ $introduce['block_3_description_'.$i] }}</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="intro-section-4 intro-section-3 mb30">
            <div class="uk-container uk-container-center">
                <h2 class="heading wow fadeInDown" data-wow-delay="0.4s">{{ $introduce['block_4_title'] }}</h2>
                <div class="uk-grid uk-grid-medium">
                    @php
                        $time = 0.2;
                    @endphp
                    @for($i = 1; $i<=4; $i++)
                        <div class="uk-width-medium-1-2 mb20">
                            <div class="whyus-item wow fadeInDown" data-wow-delay="{{ $time * ($i + 1) }}s">
                                <span class="image img-scaledown">
                                    <img src="{{ $introduce['block_4_image_'.$i] }}" alt="{{ $introduce['block_4_text_'.$i] }}">
                                </span>
                                <div class="info">
                                    <div class="title">{{ $introduce['block_4_text_'.$i] }}</div>
                                    <div class="description">{{ $introduce['block_4_description_'.$i] }}</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="intro-section-5 intro-section-3 mb30">
            <div class="uk-container uk-container-center">
                <div class="heading mb50 wow fadeInDown" data-wow-delay="0.4s">{{ $introduce['block_5_title'] }}</div>
                <div class="uk-grid uk-grid-medium">
                    @php
                        $time = 0.2;
                    @endphp
                    @for($i = 1; $i<=3; $i++)
                        <div class="uk-width-1-2 uk-width-small-1-3 uk-width-medium-1-3">
                            <div class="person-item wow fadeInDown" data-wow-delay="{{ $time * ($i + 1) }}s">
                                <span class="image img-cover img-zoom-in">
                                    <img src="{{ $introduce['block_5_image_'.$i] }}" alt="{{ $introduce['block_5_text_'.$i] }}">
                                </span>
                                <div class="title">{{ $introduce['block_5_text_'.$i] }}</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="intro-section-6">
            <div class="uk-container uk-container-center">
                <div class="panel-head">
                    <div class="heading wow fadeInDown" data-wow-delay="0.2s">Bạn đang cần giải pháp phù hợp</div>
                    <div class="description wow fadeInLeft" data-wow-delay="0.4s">Kết nối ngay với chuyên gia của chúng tôi để nhận giải pháp phù hợp.</div>
                </div>
                <div class="panel-body">
                    <div class="uk-grid uk-grid-medium">
                        <div class="uk-width-small-1-2 mb20 uk-width-medium-1-3">
                            <div class="solution-item wow fadeInDown" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="{{ asset('frontend/resources/img/solution-item.png') }}" alt="">
                                </div>
                                <div class="title">Hotline tư vấn trực tiếp</div>
                                <div class="solution-button">
                                    <a href="tel:{{ $system['contact_hotline'] }}" title="{{ $system['contact_hotline'] }}">{{ $system['contact_hotline'] }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-small-1-2 mb20 uk-width-medium-1-3">
                            <div class="solution-item wow fadeInDown" data-wow-delay="0.6s">
                                <div class="icon">
                                    <img src="{{ asset('frontend/resources/img/solution-item.png') }}" alt="">
                                </div>
                                <div class="title">Tư vấn khách hàng chat zalo</div>
                                <div class="solution-button">
                                    <a href="https://zalo.me/{{ $system['contact_hotline'] }}" title="{{ $system['contact_hotline'] }}">Chat Zalo</a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-small-1-2 mb20 uk-width-medium-1-3">
                            <div class="solution-item wow fadeInDown" data-wow-delay="0.9s">
                                <div class="icon">
                                    <img src="{{ asset('frontend/resources/img/solution-item.png') }}" alt="">
                                </div>
                                <div class="title">Để lại thông tin chúng tôi gọi lại</div>
                                <div class="solution-button">
                                    <a href="{{ write_url('lien-he') }}" title="Liên Hệ">Để lại thông tin chúng tôi gọi lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        @if(isset($widgets['students']->object) && !is_null($widgets['students']->object))
            @foreach($widgets['students']->object as $key => $val)
            <div class="intro-section-7 intro-section-3">
                <div class="uk-container uk-container-center">
                    <div class="panel-head">
                        <span class="special-text wow fadeInDown" data-wow-delay="0.3s">Đánh giá</span>
                        <h2 class="heading wow fadeInDown" data-wow-delay="0.4s">{{ $val->languages->name }}</h2>
                        <div class="description wow fadeInDown" data-wow-delay="0.5s">{!! $val->languages->description !!}</div>
                    </div>
                    <div class="panel-body">
                        @if(isset($val->posts) && count($val->posts) )
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($val->posts as $post)
                                    @php
                                        $name = $post->languages[0]->name;
                                        $description = $post->languages[0]->description;
                                        $image = $post->image;
                                    @endphp
                                    <div class="swiper-slide wow fadeInDown" data-wow-delay="0.3s">
                                        <div class="feedback-item">
                                            <span><img src="{{ asset('frontend/resources/img/star.png') }}" alt="star"></span>
                                            <div class="description">
                                                {!! $description !!}
                                            </div>
                                            <div class="info uk-flex uk-flex-right">
                                                <div class="uk-flex uk-flex-middle">
                                                    <span class="name">{{ $name }}</span>
                                                    <span class="image img-cover"><img src="{{ $image }}" alt=""></span>
                                                </div>
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
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        <div class="intro-section-8 intro-section-3">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-medium uk-flex uk-flex-middle">
                    <div class="uk-width-medium-1-2 wow fadeInDown" data-wow-delay="0.3s">
                        <div class="description">
                             <h2 class="heading">Đồng hành cùng OM'E trao đi giá trị sức khỏe đích thực cho cộng đông</h2>
                             <div class="description">
                                <p>Liên hệ ngay với chúng tôi qua số</p>
                                <p>hotline <span>{{ $system['contact_hotline'] }}</span> để được cộng tác</p>
                                <p>Chúng tôi trân trọng và rất hân hạnh được đồng hành!</p>
                             </div>
                             <div class="image">
                                <img src="{{ asset('frontend/resources/img/Image-123.png') }}" alt="">
                             </div>
                             <a href="tel:{{ $system['contact_hotline'] }}" class="button-hotlin">
                                Gọi {{ $system['contact_hotline']  }}
                             </a>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2 wow fadeInDown" data-wow-delay="0.4s">
                        <div class="image">
                            <img src="{{ asset('frontend/resources/img/section-8-bg.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   
@endsection

