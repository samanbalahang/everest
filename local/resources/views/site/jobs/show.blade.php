@extends('site.layouts.main')
@section('title')
    {{ $job->title }}
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
                @if ($job->jobCat)
                <li class="breadcrumb-item">
                    <a href="{{ route('site.jobs.category', $job->jobCat->slug) }}">
                        {{ $job->jobCat->title }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active">
                    <a href="{{ route('site.jobs.show', ['id' => $job->id, 'title' => str_replace(" ", "-", $job->title)]) }}">
                        {{ $job->title }}
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
                    <div class="card single @if ($job->expired) expired @endif">
                        @if ($job->expired)
                        <div class="expire">
                            منقضی شده
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <h1>{{ $job->title }}</h1>
                                <div class="text-justify">
                                    {!! $job->content !!}
                                </div>
                                <ul class="info">
                                    <li>
                                        <i class="fal fa-clock"></i>
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                        {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                    </li>
                                    <li>
                                        <i class="fal fa-eye"></i>
                                        {{ $job->views }} بازدید
                                    </li>
                                    @if ($job->jobCat)
                                    <li>
                                        <i class="fal fa-tag"></i>
                                        {{ $job->jobCat->title }}
                                    </li>
                                    @endif
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h3 class="title">
                        <span>آگهی های</span> مشابه
                    </h3>
                    @foreach ($similar as $item)
                    <div class="card single">
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
                                    {{ $item->desc }}...
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
                </div>
                <div class="col-md-3 visible-xs">
                    @include('site.jobs.sidebar2')
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $job->desc }}">
<meta name="keywords" content="{{ $job->desc }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $job->desc }}">
<meta property="og:image" content="{{ Seo::image('default') }}">
@endsection