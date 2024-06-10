@extends('site.layouts.main')
@section('title')
    مشتریان
@endsection
@section('main')
    <main class="customers">
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
                    <a href="{{ route('site.customers') }}">
                        مشتریان
                    </a>
                </li>
            </ul>
            @if (Banner::get('customers'))
            <div class="banner-alt">
                {!! Banner::get('customers') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>مشتریان کالج اورست</h3>
                            <h5>ما افتخار میکنیم که بیش از <span>{{ $customers->count() }} سازمان و شرکت معتبر</span> به ما اعتماد کردند</h5>
                            <p class="text-justify">
                                {!! Setting::get('customers_desc') !!}
                            </p>
                        </div>
                        <div class="w-100"></div>
                        @foreach ($customers as $item)
                        <div class="col-md-2h">
                            <div class="customerSlide">
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" title="{{ $item->name }}" class="img-fluid">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('customers') }}">
<meta name="keywords" content="{{ Seo::key('customers') }}">
<meta property="og:description" content="{{ Seo::desc('customers') }}">
<meta property="og:image" content="{{ Seo::image('customers') }}">
@endsection