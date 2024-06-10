@extends('site.layouts.main')
@section('title')
    {{ $course->title }}
@endsection
@section('main')
    <main class="course">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.courses.index') }}">
                        دوره ها
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.courses.department', $course->department->slug) }}">
                        دپارتمان {{ $course->department->title }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.courses.show', $course->slug) }}">
                        {{ $course->title }}
                    </a>
                </li>
            </ul>
            @if (Banner::get('courses'))
            <div class="banner-alt">
                {!! Banner::get('courses') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3 hidden-xs">
                    @include('site.courses.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card courseSingle">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="img-fluid">
                                </div>
                                <div class="col-md-9">
                                    <h1>{{ $course->title }}</h1>
                                    <h2>{{ $course->title_en }}</h2>
                                    <h3>شرکت {{ $course->company }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="info">
                                <li>
                                    <i class="fal fa-clock"></i>
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $course->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $course->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $course->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </li>
                                <li>
                                    <i class="fal fa-tag"></i>
                                    @if ($course->department)
                                        {{ $course->department->title }}
                                    @else
                                        بدون دپارتمان
                                    @endif
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $course->views }} بازدید
                                </li>
                            </ul>
                            <div class="section-head">
                                <h3>
                                    <i class="fal fa-info-circle"></i>
                                    معرفی {{ $course->title }}
                                </h3>
                            </div>
                            <div class="text-justify">
                                {!! $course->desc !!}
                            </div>
                            <div class="section-head">
                                <h3>
                                    <i class="fal fa-briefcase"></i>
                                    بازار کار {{ $course->title }}
                                </h3>
                            </div>
                            <div class="text-justify">
                                {!! $course->works !!}
                            </div>
                            <div class="section-head">
                                <h3>
                                    <i class="fal fa-desktop"></i>
                                    پیشنیاز {{ $course->title }}
                                </h3>
                            </div>
                            <div class="text-justify">
                                {!! $course->requires !!}
                            </div>
                            <div class="section-head">
                                <h3>
                                    <i class="fal fa-clipboard"></i>
                                    سرفصل های {{ $course->title }}
                                </h3>
                            </div>
                            <div class="text-justify">
                                {!! $course->lessons !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.courses.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $course->title }} - {{ $course->title_en }} - {{ $course->company }} - {{ $course->department->title }}">
<meta name="keywords" content="{{ $course->title }}, {{ $course->title_en }}, {{ $course->company }}, {{ $course->department->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $course->title }} - {{ $course->title_en }} - {{ $course->company }} - {{ $course->department->title }}">
<meta property="og:image" content="{{ $course->image_url }}">
@endsection