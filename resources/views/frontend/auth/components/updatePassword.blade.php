
@extends('frontend.homepage.layout')
@section('content')
    <div class="forgotpassword-container">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-center">
                <div class="forgot-password-form">
                    <form class="update-password" action="{{ route($route, $email) }}" method="post">
                        @csrf
                            <div class="form-heading">Cập nhật mật khẩu</div>
                            <div class="description mb20">
                                Nhập đầy đủ mật khẩu mới, và xác nhận lại mật khẩu mới của bạn
                            </div>
                            <div class="form-row mb10">
                                <input 
                                    type="password" 
                                    class="input-text" 
                                    name="password"
                                    placeholder="Mật khẩu"
                                >
                            </div>
                            <div class="form-row">
                                <input 
                                    type="password" 
                                    class="input-text" 
                                    name="re_password"
                                    placeholder="Nhập lại mật khẩu"
                                >
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Đổi mật khẩu</button>  
                    </form>
                    <p class="m-t mt5">
                        <small>{{ $system['homepage_brand'] }} System 2023</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
