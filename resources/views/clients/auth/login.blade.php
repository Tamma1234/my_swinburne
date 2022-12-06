@extends('clients.layouts.dashboard')
@section('title', 'Create')

@section('content')
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" style="background-image: url({{ asset('assets/images/bg-3.jpg') }});">
            <div class="kt-login__left">
                <div class="kt-login__wrapper">
                    <div class="kt-login__content">
                        <a class="kt-login__logo" href="#">
                            <img src="{{ asset('assets/images/logo-swb.jpg') }}" style="width: 200px">
                        </a>
                        <h3 class="kt-login__title">JOIN OUR GREAT COMMUNITY</h3>
                        <div class="kt-login__actions">
                            <a href="{{ route('register') }}" id="" class="btn btn-outline-brand btn-pill">Đăng Ký</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-login__divider">
                <div></div>
            </div>
            <div class="kt-login__right">
                <div class="kt-login__wrapper">
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Login To Your Account</h3>
                        </div>
                        <div class="kt-login__form">
                            <form class="kt-form" action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Username" name="email" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-last" type="Password" placeholder="Password" name="password">
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col kt-align-left">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember"> Remember me
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col kt-align-right">
                                        <a href="javascript:;" id="kt_login_forgot" class="kt-link">Forget Password ?</a>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button type="submit" id="" class="btn btn-brand btn-pill btn-elevate">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Forgotten Password ?</h3>
                            <div class="kt-login__desc">Enter your email to reset your password:</div>
                        </div>
                        <div class="kt-login__form">
                            <form class="kt-form" action="">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
                                    <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
