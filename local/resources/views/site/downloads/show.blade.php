@extends('site.layouts.main')
@section('title')
    {{ $download->title }}
@endsection
@section('main')
    <main class="download">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.downloads.index') }}">
                        دانلود
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.downloads.show', ['id' => $download->id, 'title' => str_replace(" ", "-", $download->title)]) }}">
                        {{ $download->title }}
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
                    <div class="card downloadSingle">
                        <div class="card-header">
                            <h1>{{ $download->title }}</h1>
                        </div>
                        <div class="card-body">
                            <ul class="info">
                                <li>
                                    <i class="fal fa-clock"></i>
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $download->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $download->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $download->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </li>
                                <li>
                                    <i class="fal fa-tag"></i>
                                    @if ($download->downloadCat)
                                        {{ $download->downloadCat->title }}
                                    @else
                                        دسته بندی نشده
                                    @endif
                                </li>
                                <li>
                                    <i class="fal fa-eye"></i>
                                    {{ $download->views }} بازدید
                                </li>
                                <li>
                                    <i class="fal fa-cloud-download"></i>
                                    {{ $download->downloads }} دانلود
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-md-2 col-4">
                                    <img src="{{ $download->thumb_url }}" alt="{{ $download->title }}" class="img-fluid">
                                </div>
                                <div class="col-md-10 col-8">
                                    <div class="text-justify">
                                        {!! $download->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="downloadSection">
                            <div class="row align-items-center">
                                <div class="col-md-8"></div>
                                <div class="col-md-2">
                                    <div>
                                        <span>حجم :</span> <strong dir="ltr">@if ($fileSize > 1) {{ $fileSize }} MB @else {{ $fileSize * 1000 }} KB @endif</strong>
                                    </div>
                                    <div>
                                        <span>فرمت :</span> <strong dir="ltr">{{ $fileMime }}</strong>
                                    </div>
                                </div>
                                {!! Form::model($download, [
                                    'method' => 'post',
                                    'route' => 'site.downloads.file',
                                    'class' => 'col-md-2 text-left'
                                ]) !!}
                                    <input type="hidden" name="id" value="{{ $download->id }}">
                                    <input type="hidden" name="file" value="{{ $download->file }}">
                                    <div class="text-left">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fal fa-download"></i>
                                            دانلود
                                        </button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
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
<meta name="description" content="{{ $download->desc }}">
<meta name="keywords" content="{{ $download->desc }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $download->desc }}">
<meta property="og:image" content="{{ $download->image_url }}">
@endsection