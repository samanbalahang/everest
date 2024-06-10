@extends('site.layouts.main')
@section('title')
    درخواست مشاوره
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
                    <a href="{{ route('site.moshavere') }}">
                        درخواست مشاوره
                    </a>
                </li>
            </ul>
            <div class="row" style="justify-content: center;">
                <div class="col-md-6">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    {!! Form::open([
                        'route' => 'site.moshavere.submit',
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
                            {!! Form::label('method_id', 'نحوه آشنایی با ما (الزامی)') !!}
                            {!! Form::select('method_id', App\Method::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label class="d-block">علاقه‌مندی‌ها (اختیاری)</label>
                            @foreach ($favs as $item)
                            <input type="checkbox" name="favs[]" id="fav_{{ $item->id }}" value="{{ $item->title }}">
                            <label for="fav_{{ $item->id }}">{{ $item->title }}</label>
                            @endforeach
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
                            درخواست مشاوره
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </main>
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