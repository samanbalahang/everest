@extends('panel.auth.layouts.app')
@section('title')
    ورود
@endsection
@section('main')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('admin/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <h5 class="font-medium m-b-20">ورود به پنل</h5>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" id="loginform" action="{{ route('login') }}" method="POST" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control form-control-lg" placeholder="ایمیل" aria-label="ایمیل" aria-describedby="basic-addon1">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <input id="password" type="password" name="password" required class="form-control form-control-lg" placeholder="رمز عبور" aria-label="رمز عبور" aria-describedby="basic-addon1">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">مرا به خاطر بسپار</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="col-xs-12">
                                <button class="btn btn-block btn-lg btn-info" type="submit">ورود</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
@endsection