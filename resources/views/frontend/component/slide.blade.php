@php
    $slideKeyword = App\Enums\SlideEnum::MAIN;
@endphp
@if(count($slides[$slideKeyword]['item']))
    <div class="panel-slide page-setup">
        <div class="swiper-button-prev">
        </div>
        <div class="swiper-button-next">
        </div>
        <div class="uk-container uk-container-center">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    {{-- @dd($slides) --}}
                    @foreach($slides[$slideKeyword]['item'] as $key => $val )
                        <div class="swiper-slide">
                            
                                <div class="uk-grid uk-grid-collapse">
                                    <div class="uk-width-medium-1-2">
                                        <div class="text">
                                            <h3 class="heading-2 wow fadeInDown" data-wow-duration="1s"><span>{{ $val['description'] }}</span></h3>
                                            <h2 class="heading-1 wow fadeInLeft" data-wow-delay="0.3s"><span>{!! $val['name'] !!}</span></h2>
                                            <div class="alt wow fadeInRight" data-wow-delay="0.6s">
                                                <p>{{ $val['alt'] }}</p>
                                            </div>
                                            <div class="group-btn">
                                                <div class="uk-flex uk-flex-middle">
                                                    <a target="_blank" href="{{ $val['canonical'] }}" title="" class="btn btn-view wow pulse" data-wow-iteration="3">
                                                        <span>Xem khóa học</span>
                                                    </a>
                                                    <a href="#panel-contact" title="" class="btn btn-register wow tada" data-wow-delay="1s">
                                                        <span>Nhận tư vấn miễn phí</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2">
                                        <a href="{{ $val['canonical'] }}" title="" class="image img-scaledown wow fadeInRight" data-wow-delay="0.8s">
                                            <img src="{{ $val['image'] }}" alt="{{ $val['name'] }}">
                                        </a>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <img src="/userfiles/image/4d8ba71a051991426690d48c1d5587511115f248.png" class="img-ab img-1 wow fadeInDown"  data-wow-delay="0.8s" alt="">
            <img src="/userfiles/image/d7230fdf1c3495b8f67183ace9f13f58440b0898.png" class="img-ab img-2 wow fadeInDown"  data-wow-delay="0.8s" alt="">
            <img src="/userfiles/image/7475bede1db53dac1230fbd9b1cb8f3460b53afc.png" class="img-ab img-3 wow fadeInDown"  data-wow-delay="0.8s" alt="">
            <img src="/userfiles/image/b0eb01b0f2a773588cdb6e35884fd4d92283e880.png" class="img-ab img-4 wow fadeInDown"  data-wow-delay="0.8s" alt="">
            <img src="/userfiles/image/f0b3a76cfe163969965a7042a6ad44a0a65bc429.png" class="img-ab img-5 wow fadeInDown"  data-wow-delay="0.8s"alt="">
        </div>
    </div>
@endif