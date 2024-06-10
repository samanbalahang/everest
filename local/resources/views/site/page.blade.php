@extends('site.layouts.main')
@section('title')
    {{ $page->title }}
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
                    <a href="{{ route('site.page', $page->slug) }}">
                        {{ $page->title }}
                    </a>
                </li>
            </ul>
            @if ($page->image_url)
            <img src="{{ $page->image_url }}" alt="{{ $page->title }}" class="img-fluid">
            @endif
            <h4>{{ $page->title }}</h4>
            {!! $page->content !!}
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $page->title }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $page->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $page->title }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ ($page->image_url) ? $page->image_url : Seo::image('default') }}">
@endsection