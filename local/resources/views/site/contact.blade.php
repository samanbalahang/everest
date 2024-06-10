@extends('site.layouts.main')
@section('title')
    تماس با ما
@endsection
@section('main')
    <style>
        input::-webkit-inner-spin-button,
        input::-webkit-outer-spin-button {
            display: none;
            appearance: none;
        }
    </style>
    <main class="contact">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('site.contact') }}">
                        تماس با ما
                    </a>
                </li>
            </ul>
            @if (Banner::get('contact'))
            <div class="banner-alt">
                {!! Banner::get('contact') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4 visible-xs">
                    <div class="card info">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <span>
                                        <i class="fal fa-map-marker"></i>
                                    </span>
                                    <strong>
                                        کرج ، سه راه گوهردشت ، نبش دهقان ویلای دوم ، آموزشگاه اورست
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-phone"></i>
                                    </span>
                                    <strong>
                                        34464106 <br>
                                        34464793
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-envelope"></i>
                                    </span>
                                    <strong>
                                        unieverest@gmail.com
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-comment"></i>
                                    </span>
                                    <strong>
                                        5000234370
                                    </strong>
                                </li>
                            </ul>
                            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3234.647993405425!2d50.95193361489992!3d35.83311132923542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8dbf272a32fdbf%3A0x7b9fa8fd3b16f6a0!2z2KLZhdmI2LLYtNqv2KfZhyDaqdin2YXZvtuM2YjYqtixINin2YjYsdiz2Ko!5e0!3m2!1sen!2s!4v1540225002234" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>  --}}
                            <iframe src="https://balad.ir/embed?p=4w8DAKkgKeUtXm" title="مشاهده «آموزشگاه کامپیوتر اورست» روی نقشه بلد" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <br><br>
                </div>
                <div class="col-md-6">
                    <h5>با ما در تماس باشید...</h5>
                    <h4>
                        منتظر شنیدن <span>صدای</span> گرمتان هستیم
                    </h4>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    {!! Form::model($message, [
                        'route' => 'site.message',
                        'method' => 'post',
                        'onsubmit' => 'check_if_capcha_is_filled',
                        'files' =>  TRUE,
                        'autocomplete' => 'off',
                    ]) !!}
                        <input type="text" name="hidden" autocomplete="off" style="display: none">
                        <div class="form-group">
                            {!! Form::label('name', 'نام شما (الزامی)') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                            @if ($errors->has('name'))
                                <span class="text-danger help-block">
                                    <strong>لطفا نام خود را وارد کنید!</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'ایمیل شما (الزامی)') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                            @if ($errors->has('email'))
                                <span class="text-danger help-block">
                                    <strong>لطفا ایمیل خود را وارد کنید!</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('mobile', 'شماره همراه (الزامی)') !!}
                            {!! Form::number('mobile', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                            @if ($errors->has('mobile'))
                                <span class="text-danger help-block">
                                    <strong>لطفا شماره همراه خود را وارد کنید!</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('file', 'فایل ضمیمه') !!} <br>
                            {!! Form::file('file', null, ['class' => 'form-control']) !!} <br>
                            <span>فایل‌های مجاز : PDF, Word, Excel, PPT, Zip, MP3, MP4, JPEG, JPG</span>
                            <span>حداکثر حجم مجاز : 50 مگابایت</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('message', 'متن پیام (الزامی)') !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'autocomplete' => 'off']) !!}
                            @if ($errors->has('message'))
                                <span class="text-danger help-block">
                                    <strong>لطفا پیام خود را وارد کنید!</strong>
                                </span>
                            @endif
                        </div>
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
                        <button type="submit" class="btn btn-primary">
                            ارسال پیام
                        </button>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4 hidden-xs">
                    <div class="card info">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <span>
                                        <i class="fal fa-map-marker"></i>
                                    </span>
                                    <strong>
                                        {{ Setting::get('contact_address') }}
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-phone"></i>
                                    </span>
                                    <strong>
                                        {{ Setting::get('contact_phone1') }} <br>
                                        {{ Setting::get('contact_phone2') }}
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-envelope"></i>
                                    </span>
                                    <strong>
                                        {{ Setting::get('contact_email') }}
                                    </strong>
                                </li>
                                <li>
                                    <span>
                                        <i class="fal fa-comment"></i>
                                    </span>
                                    <strong>
                                        {{ Setting::get('contact_sms') }}
                                    </strong>
                                </li>
                            </ul>
                            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3234.647993405425!2d50.95193361489992!3d35.83311132923542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8dbf272a32fdbf%3A0x7b9fa8fd3b16f6a0!2z2KLZhdmI2LLYtNqv2KfZhyDaqdin2YXZvtuM2YjYqtixINin2YjYsdiz2Ko!5e0!3m2!1sen!2s!4v1540225002234" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>  --}}
                            <iframe src="https://balad.ir/embed?p=4w8DAKkgKeUtXm" title="مشاهده «آموزشگاه کامپیوتر اورست» روی نقشه بلد" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('contact') }}">
<meta name="keywords" content="{{ Seo::key('contact') }}">
<meta property="og:description" content="{{ Seo::desc('contact') }}">
<meta property="og:image" content="{{ Seo::image('contact') }}">
@endsection
@section('scripts')
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
@endsection