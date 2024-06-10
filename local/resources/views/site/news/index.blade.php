@extends('site.layouts.main')
@section('title')
    اخبار
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
            </ul>
            @if (Banner::get('news'))
            <div class="banner-alt">
                {!! Banner::get('news') !!}
            </div>
            @endif
            <div class="row">
                @php
                    $i = 1;
                @endphp
                @foreach ($news as $item)
                <div class="col-md-12">
                    <div class="card single">
                        <div class="row">
                            <div @if ($i == 1) class="col-md-4" @else class="col-md-2" @endif>
                                <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <h2>
                                    <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                        {{ $item->title }}
                                    </a>    
                                </h2>
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
                                        <i class="fal fa-eye"></i>
                                        {{ $item->views }} بازدید
                                    </li>
                                </ul>
                                <div class="text-justify">
                                    {{ $item->desc }}
                                </div>
                                <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="btn btn-sm">
                                    مشاهده خبر
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
                @endforeach
            </div>
            <div class="text-center">
                {{ $news->render() }}
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('news') }}">
<meta name="keywords" content="{{ Seo::key('news') }}">
<meta property="og:description" content="{{ Seo::desc('news') }}">
<meta property="og:image" content="{{ Seo::image('news') }}">
@endsection