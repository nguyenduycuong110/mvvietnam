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
                </ul>
            </div>
            @if($allLecturers)
                <div class="uk-grid uk-grid-medium">
                    @foreach($allLecturers as $item)
                        <div class="uk-width-medium-1-5">
                            <div class="lecturer-item">
                                <a href="{{ write_url('giao-vien/'. $item['canonical']) }}" class="image img-cover">
                                    <img src="{{ $item['image'] }}" alt="">
                                </a>
                                <div class="text-content">
                                    <h3 class="heading-2"><a href="{{ write_url('giao-vien/'. $item['canonical']) }}" title="">{{ $item['name'] }}</a></h3>
                                    <p>{{ $item['position'] }}</p>
                                    <div class="courses">
                                        <div class="uk-flex uk-flex-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open w-3 h-3">
                                                <path d="M12 7v14"></path><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                                            </svg>
                                            <span>{{ $item['courses'] }} khóa học</span>
                                        </div >
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
