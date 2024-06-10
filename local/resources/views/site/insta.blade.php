<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="ARYA Creative Agency">
        <meta name="copyright" content="{{ Setting::get('copyright_meta') }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ Request::url() }}">
        <meta property="og:title" content="درخواست مشاوره">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="{{ Setting::get('site_title') }}">
        <title>درخواست مشاوره | {{ Setting::get('site_title') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <script>window.Laravel={csrfToken:"{{ csrf_token() }}"};</script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123056459-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-123056459-2');
        </script>
        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background: #d6249f;
                background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);
            }
            .row {
                justify-content: center;
            }
            .card {
                margin-top: 1rem;
            }
            h2 {
                font-size: 18px;
            }
            .card .row {
                align-items: center;
            }
            input::-webkit-inner-spin-button,
            input::-webkit-outer-spin-button {
                display: none;
                appearance: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h2>درخواست مشاوره</h2>    
                                </div>
                                <div class="col-6">
                                    <a href="https://uni-everest.com" class="logo" target="_blank">
                                        <img src=" https://uni-everest.com/images/logo.png " alt="{{ Setting::get('site_title') }}" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            {!! Form::open([
                                'route' => 'site.insta.submit',
                                'method' => 'post',
                                'onsubmit' => 'check_if_capcha_is_filled',
                                'autocomplete' => 'off',
                            ]) !!}
                                <input type="text" name="hidden" autocomplete="off" style="display: none">
                                <div class="form-group">
                                    {!! Form::label('name', 'نام و نام خانوادگی (الزامی)') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                                    @if ($errors->has('name'))
                                        <span class="text-danger help-block">
                                            <strong>لطفا نام خود را وارد کنید!</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('mobile', 'شماره همراه (الزامی)') !!}
                                    {!! Form::number('mobile', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger help-block">
                                            <strong>لطفا شماره همراه خود را به درستی وارد کنید!</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="d-block">علاقه‌مندی‌ها (اختیاری)</label>
                                    @foreach ($favs as $item)
                                    <div class="d-inline-block">
                                        <input type="checkbox" name="favs[]" id="fav_{{ $item->id }}" value="{{ $item->title }}">
                                        <label for="fav_{{ $item->id }}">{{ $item->title }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="method_id" value="1">
                                <div class="form-group">
                                    {!! Form::label('captcha', 'کد امنیتی') !!} <br>
                                    <div id="captchadiv" class="d-inline-block">
                                        {!! Captcha::img() !!}
                                    </div>
                                    <button type="button" id="reload" class="btn btn-sm btn-dark">
                                        <i class="fa fa-repeat"></i>
                                    </button>
                                    {!! Form::text('captcha', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                                    @if ($errors->has('captcha'))
                                        <span class="text-danger help-block">
                                            <strong>لطفا کد امنیتی را به صورت صحیح وارد کنید!</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        ارسال درخواست
                                    </button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/newsletter.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('#reload').on('click', function(){
                    $.ajax({
                        type: 'GET',
                        url: '/api/captcha/ref',
                        success: function(data) {
                            $("#captchadiv").html(data);
                        }
                    });
                });
            });
        </script>
        {{-- <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c00ebdbe81b2bef"></script> --}}
    </body>
</html>