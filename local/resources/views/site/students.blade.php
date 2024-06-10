@extends('site.layouts.main')
@section('title')
    دانشجویان مشغول به کار
@endsection
@section('main')
    <main class="students">
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
                    <a href="{{ route('site.students') }}">
                        دانشجویان مشغول به کار
                    </a>
                </li>
            </ul>
            @if (Banner::get('students'))
            <div class="banner-alt">
                {!! Banner::get('students') !!}
            </div>
            @endif
            <div class="card numbers">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <i class="fa fa-user"></i>
                            <h5>کل دانشجویان</h5>
                            <h4>{{ Number::get('all_students') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-briefcase"></i>
                            <h5>دانشجویان مشغول به کار شده</h5>
                            <h4>{{ Number::get('work_students') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-book"></i>
                            <h5>دانشجویان در حال تدریس</h5>
                            <h4>{{ Number::get('study_students') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-smile"></i>
                            <h5>میزان رضایت</h5>
                            <h4>{{ Number::get('testimonial') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                    <div class="card courseList hidden-xs">
                        <div class="card-header">
                            <strong>برخی از دوره ها</strong>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($courses as $item)
                                <li>
                                    <a href="{{ route('site.courses.show', $item->slug) }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        {{ $item->title }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($students as $item)
                        <div class="col-md-4">
                            <div class="studentSingle">
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="img-fluid">
                                <h5>{{ $item->name }}</h5>
                                <ul>
                                    <li>
                                        تاریخ عضویت : {{ $item->year }}
                                    </li>
                                    <li>
                                        <strong>دوره های گذرانده شده :</strong>
                                        <p>
                                            {{ $item->courses }}
                                        </p>
                                    </li>
                                    <li>
                                        <strong>شرکت استخدام شده :</strong>
                                        <span>{{ $item->company }}</span>
                                    </li>
                                    <li>
                                        <strong>سمت شغلی :</strong>
                                        <span>{{ $item->headline }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12 text-center">
                            {{ $students->render() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 visible-xs">
                    <div class="card courseList">
                        <div class="card-header">
                            <strong>برخی از دوره ها</strong>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($courses as $item)
                                <li>
                                    <a href="{{ route('site.courses.show', $item->slug) }}">
                                        <i class="fal fa-angle-double-left"></i>
                                        {{ $item->title }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('students') }}">
<meta name="keywords" content="{{ Seo::key('students') }}">
<meta property="og:description" content="{{ Seo::desc('students') }}">
<meta property="og:image" content="{{ Seo::image('students') }}">
@endsection