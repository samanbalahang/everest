@extends('site.layouts.main')
@section('title')
    نظرات
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
                    <div class="row">
                        @foreach ($testimonials as $item)
                        <div class="col-md-3">
                            <div class="card single">
                                <div class="card-body">
                                    <a href="{{ route('site.testimonials.show', $item->id) }}">
                                        <video src="{{ $item->video_url }}" class="img-fluid"></video>
                                    </a>
                                    <strong>
                                        نظر {{ $item->name }}
                                    </strong>
                                    <span>
                                        دانشجوی دوره {{ $item->course }}
                                    </span>
                                    <div class="text-center">
                                        <i class="fal fa-clock"></i>
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                        {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                    </div>
                                    <div class="text-center">
                                        <i class="fal fa-eye"></i>
                                        {{ $item->views }} بازدید
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{ $testimonials->render() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('testimonials') }}">
<meta name="keywords" content="{{ Seo::key('testimonials') }}">
<meta property="og:description" content="{{ Seo::desc('testimonials') }}">
<meta property="og:image" content="{{ Seo::image('testimonials') }}">
@endsection