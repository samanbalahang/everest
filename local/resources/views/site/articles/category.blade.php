@extends('site.layouts.main')
@section('title')
    {{ $articleCat->title }}
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
                <li class="breadcrumb-item">
                    <a href="{{ route('site.articles.category', $articleCat->slug) }}">
                        {{ $articleCat->title }}
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
                    <h1 class="title">
                        <span>دسته بندی</span> {{ $articleCat->title }}
                    </h1>
                    @if ($articles->count() > 0)
                    @foreach ($articles as $item)
                    <div class="card articleSingle">
                        <div class="card-header">
                            <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2>{{ $item->title }}</h2>
                            <ul class="info">
                                <li>
                                    <i class="fal fa-clock"></i>
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </li>
                                <li>
                                    <i class="fal fa-tag"></i>
                                    @if ($item->articleCat)
                                        {{ $item->articleCat->title }}
                                    @else
                                        دسته بندی نشده
                                    @endif
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $item->views }} بازدید
                                </li>
                            </ul>
                            <div class="text-justify">
                                {{ $item->desc }}
                            </div>
                            <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="btn btn-sm">
                                ادامه مطلب...
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center">
                        {{ $articles->render() }}
                    </div>
                    @else
                    <div class="alert alert-warning">
                        پستی یافت نشد!
                    </div>
                    @endif
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.articles.sidebar2')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $articleCat->title }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $articleCat->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $articleCat->title }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ Seo::image('default') }}">
@endsection