@extends('site.layouts.main')
@section('title')
    {{ $about->title }}
@endsection
@section('main')
    <main class="about">
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
                @if ($about->slug != 'about')
                <li class="breadcrumb-item">
                    <a href="{{ route('site.aboutin', $about->slug) }}">
                        {{ $about->title }}
                    </a>
                </li>
                @endif
            </ul>
            @if (Banner::get('about'))
            <div class="banner-alt">
                {!! Banner::get('about') !!}
            </div>
            @endif
            <div class="card numbers">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2h">
                            <i class="fa fa-user-tie"></i>
                            <h5>کل اساتید</h5>
                            <h4>{{ Number::get('all_lecturers') }}</h4>
                        </div>
                        <div class="col-md-2h">
                            <i class="fa fa-user-check"></i>
                            <h5>اساتید فعال</h5>
                            <h4>{{ Number::get('active_lecturers') }}</h4>
                        </div>
                        <div class="col-md-2h">
                            <i class="fa fa-user-graduate"></i>
                            <h5>کل دانشجویان</h5>
                            <h4>{{ Number::get('all_students') }}</h4>
                        </div>
                        <div class="col-md-2h">
                            <i class="fa fa-users"></i>
                            <h5>استخدام شده</h5>
                            <h4>{{ Number::get('work_students') }}</h4>
                        </div>
                        <div class="col-md-2h">
                            <i class="fa fa-graduation-cap"></i>
                            <h5>کل دوره ها</h5>
                            <h4>{{ Number::get('all_courses') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                </div>
                <div class="col-md-9">
                    @if ($about->image_url)
                    <img src="{{ $about->image_url }}" alt="{{ $about->title }}" class="img-fluid">
                    @endif
                    <h4>{{ $about->title }}</h4>
                    {!! $about->content !!}
                    <br><br>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $about->title }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $about->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $about->title }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ $about->image_url }}">
@endsection