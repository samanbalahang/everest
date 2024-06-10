@extends('site.layouts.main')
@section('title')
    نظر {{ $testimonial->name }}
@endsection
@section('main')
    <main class="testimonials">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.about') }}">
                        درباره ما
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.testimonials.index') }}">
                        نظرات
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.testimonials.show', $testimonial->id) }}">
                        نظر {{ $testimonial->name }}
                    </a>
                </li>
            </ul>
            @if (Banner::get('testimonials'))
            <div class="banner-alt">
                {!! Banner::get('testimonials') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                </div>
                <div class="col-md-9">
                    <h1 class="title">
                        <span>نظر</span> {{ $testimonial->name }}
                    </h1>
                    @php
                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $testimonial->created_at)->year;
                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $testimonial->created_at)->month;
                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $testimonial->created_at)->day;
                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                    @endphp
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <span>دانشجوی دوره</span> <strong>{{ $testimonial->course }}</strong> /
                            <span>تاریخ</span> <strong>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</strong> /
                            <span>بازدید</span> <strong>{{ $testimonial->views }}</strong>
                        </div>
                        <div class="col-md-6 text-left">
                            <a href="{{ route('site.testimonials.index') }}" class="btn btn-primary btn-sm">
                                بازگشت به لیست
                                <i class="fal fa-angle-left"></i>
                            </a>
                        </div>
                    </div>
                    <br>
                    <video controls width="100%">
                        <source src="{{ $testimonial->video_url }}" />
                        متاسفانه مرورگر شما از پخش ویدئو پشتیبانی نمی کند.
                    </video>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $testimonial->name }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $testimonial->name }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $testimonial->name }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ Seo::image('default') }}">
@endsection