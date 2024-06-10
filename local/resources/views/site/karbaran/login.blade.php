@extends('panel.auth.layouts.app')
@section('title')
    ورود
@endsection
@section('main')
@if(session('message'))
		<div class="alert  bg-success w-100 text-center" role="alert" id="alert">
			{{session('message')}}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('admin/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
       
    <div class="auth-box">
        <div id="loginform">
            <div class="logo">
                <h5 class="font-medium m-b-20">
                    ورود به پنل سیگنال
                </h5>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" id="loginforms" action="{{route('site.signal.store') }}" method="POST" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <input id="karbar_phone" type="text" name="karbar_phone" value="{{ old('karbar_phone') }}" required autofocus class="form-control form-control-lg" placeholder="تلفن" aria-label="تلفن" aria-describedby="basic-addon1" autocomplete="off" onkeypress="allowNumbersOnly(event)">
                            @if ($errors->has('karbar_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('karbar_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <input id="password" type="password" name="password" required class="form-control form-control-lg" placeholder="رمز عبور" aria-label="رمز عبور" aria-describedby="basic-addon1" autocomplete="new-password">
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
                        <div class="d-flrx my-3">
                            <input type="text" id="securnumber">
                            <span id="firstNum"></span>
                            +
                            <span id="secNum"></span>
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
    var firstRand = Math.floor((Math.random()*11)+1);
    var secRand   = Math.floor((Math.random()*11)+1);
    $("#firstNum").text(firstRand);
    $("#secNum").text(secRand);
    $("#loginforms").on("submit",function(e){
        console.log("form submit");
        // e.preventDefault();
        if($("#securnumber").val() == parseInt($("#firstNum").text())+parseInt($("#secNum").text())){
            console.log("if");
            return true;
        }else{
            console.log("else");
      
            $("#securnumber").focus();
            $("#securnumber").css("border","1px solid red");
            return false;

        }
    })
    
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
    </script>
@endsection