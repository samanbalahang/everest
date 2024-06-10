@extends('site.layouts.main')
@section('title')
    دانلود
@endsection
@section('main')
    <main class="downloads">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('site.downloads.index') }}">
                        دانلود
                    </a>
                </li>
            </ul>
            @if (Banner::get('downloads'))
            <div class="banner-alt">
                {!! Banner::get('downloads') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.downloads.sidebar')
                </div>
                <div class="col-md-9">
                    @foreach ($downloads as $item)
                    <div class="card downloadSingle">
                        <div class="card-header">
                            <a href="{{ route('site.downloads.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                <h2>{{ $item->title }}</h2>
                            </a>
                        </div>
                        <div class="card-body">
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
                                    @if ($item->downloadCat)
                                        {{ $item->downloadCat->title }}
                                    @else
                                        دسته بندی نشده
                                    @endif
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $item->views }} بازدید
                                </li>
                                <li>
                                    <i class="fal fa-cloud-download"></i>
                                    {{ $item->downloads }} دانلود
                                </li>
                            </ul>
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="text-justify">
                                        {{ $item->desc }}
                                    </div>
                                </div>
                                <div class="col-md-2 text-left">
                                    <a href="{{ route('site.downloads.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="btn btn-sm">
                                        دانلود
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center">
                        {{ $downloads->render() }}
                    </div>
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.downloads.sidebar2')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('downloads') }}">
<meta name="keywords" content="{{ Seo::key('downloads') }}">
<meta property="og:description" content="{{ Seo::desc('downloads') }}">
<meta property="og:image" content="{{ Seo::image('downloads') }}">
@endsection