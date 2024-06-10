@extends('site.layouts.main')
@section('title')
    آگهی های استخدام {{ $cat->title }}
@endsection
@section('main')
    <main class="jobs">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.jobs.index') }}">
                        آگهی های استخدام
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('site.jobs.category', $cat->slug) }}">
                        {{ $cat->title }}
                    </a>
                </li>
            </ul>
            @if (Banner::get('jobs'))
            <div class="banner-alt">
                {!! Banner::get('jobs') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('site.jobs.sidebar')
                </div>
                <div class="col-md-9">
                    <h3 class="title">
                        <span>آگهی های</span> {{ $cat->title }}
                    </h3>
                    @if ($jobs->count() > 0)
                    @foreach ($jobs as $item)
                    <div class="card single @if ($item->expired) expired @endif">
                        @if ($item->expired)
                        <div class="expire">
                            منقضی شده
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-2">
                                <div class="date">
                                    @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    <span>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <a href="{{ route('site.jobs.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <div class="text-justify">
                                    {{ $item->desc }}
                                </div>
                                <ul class="info">
                                    <li>
                                        <i class="fal fa-eye"></i>
                                        {{ $item->views }} بازدید
                                    </li>
                                    @if ($item->jobCat)
                                    <li>
                                        <i class="fal fa-tag"></i>
                                        {{ $item->jobCat->title }}
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('site.jobs.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                            مشاهده آگهی
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center">
                        {{ $jobs->render() }}
                    </div>
                    @else
                    <div class="alert alert-warning">
                        آگهی یافت نشد!
                    </div>
                    @endif
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.jobs.sidebar2')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $cat->title }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $cat->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $cat->title }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ Seo::image('default') }}">
@endsection