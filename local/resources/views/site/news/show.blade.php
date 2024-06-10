@extends('site.layouts.main')
@section('title')
    {{ $news->title }}
@endsection
@section('main')
    <main class="news">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.news.index') }}">
                        اخبار
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.news.show', ['id' => $news->id, 'title' => str_replace(" ", "-", $news->title)]) }}">
                        {{ $news->title }}
                    </a>
                </li>
            </ul>
            @if (Banner::get('news'))
            <div class="banner-alt">
                {!! Banner::get('news') !!}
            </div>
            @endif
            <div class="text-left">
                <a href="{{ route('site.news.index') }}" class="btn btn-primary btn-sm">
                    بازگشت به لیست اخبار
                    <i class="fal fa-angle-left"></i>
                </a>
                <br>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card single">
                        <div class="card-body">
                            <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="img-fluid">
                            <br>
                            <br>
                            <h1>{{ $news->title }}</h1>
                            <ul class="info">
                                <li>
                                    <i class="fal fa-clock"></i>
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $news->views }} بازدید
                                </li>
                            </ul>
                            <div class="text-justify">
                                {!! $news->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $news->desc }}">
<meta name="keywords" content="{{ $news->desc }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $news->desc }}">
<meta property="og:image" content="{{ $news->image_url }}">
@endsection