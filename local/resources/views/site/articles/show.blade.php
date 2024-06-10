@extends('site.layouts.main')
@section('title')
    {{ $article->title }}
@endsection
@section('main')
    <main class="articles">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.articles.index') }}">
                        مقالات
                    </a>
                </li>
                @if ($article->articleCat)
                <li class="breadcrumb-item">
                    <a href="{{ route('site.articles.category', $article->articleCat->slug) }}">
                        {{ $article->articleCat->title }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item">
                    <a href="{{ route('site.articles.show', ['id' => $article->id, 'title' => str_replace(" ", "-", $article->title)]) }}">
                        {{ $article->title }}
                    </a>
                </li>
            </ul>
            @if (Banner::get('articles'))
            <div class="banner-alt">
                {!! Banner::get('articles') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.articles.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card articleSingle">
                        <div class="card-header">
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h1>{{ $article->title }}</h1>
                            <ul class="info">
                                <li>
                                    <i class="fal fa-clock"></i>
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </li>
                                <li>
                                    <i class="fal fa-tag"></i>
                                    @if ($article->articleCat)
                                        {{ $article->articleCat->title }}
                                    @else
                                        دسته بندی نشده
                                    @endif
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $article->views }} بازدید
                                </li>
                            </ul>
                            <div class="text-justify">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.articles.sidebar2')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $article->desc }}">
<meta name="keywords" content="{{ str_replace(' ', ',', $article->desc) }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $article->desc }}">
<meta property="og:image" content="{{ $article->image_url }}">
@endsection