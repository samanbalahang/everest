@extends('site.layouts.main')
@section('title')
    اساتید
@endsection
@section('main')
    <main class="lecturers">
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
                    <a href="{{ route('site.lecturers') }}">
                        اساتید
                    </a>
                </li>
            </ul>
            @if (Banner::get('lecturers'))
            <div class="banner-alt">
                {!! Banner::get('lecturers') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($lecturers as $item)
                        <div class="col-md-3 col-6">
                            <div class="lecturerSingle">
                                <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="img-fluid">
                                <h4>{{ $item->name }}</h4>
                                <div class="years">
                                    <strong>{{ $item->year }}</strong>
                                    <span>سال سابقه</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12 text-center">
                            {{ $lecturers->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('lecturers') }}">
<meta name="keywords" content="{{ Seo::key('lecturers') }}">
<meta property="og:description" content="{{ Seo::desc('lecturers') }}">
<meta property="og:image" content="{{ Seo::image('lecturers') }}">
@endsection