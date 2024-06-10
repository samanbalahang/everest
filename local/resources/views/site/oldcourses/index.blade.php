@extends('site.layouts.main')
@section('title')
    دوره‌های برگزار شده
@endsection
@section('main')
    <main class="oldcourses">
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
                    <a href="{{ route('site.oldcourses.index') }}">
                        دوره‌های برگزار شده
                    </a>
                </li>
            </ul>
            @if (Banner::get('oldcourses'))
            <div class="banner-alt">
                {!! Banner::get('oldcourses') !!}
            </div>
            @endif
            <div class="card numbers">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <i class="fa fa-book"></i>
                            <h5>کل دوره‌های تشکیل شده</h5>
                            <h4>{{ Number::get('all_courses') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-code"></i>
                            <h5>دوره‌های برنامه نویسی</h5>
                            <h4>{{ Number::get('course_program') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-server"></i>
                            <h5>دوره‌های شبکه</h5>
                            <h4>{{ Number::get('course_network') }}</h4>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-desktop"></i>
                            <h5>دوره‌های کامپیوتر</h5>
                            <h4>{{ Number::get('course_computer') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::model($courses, [
                'route' => 'site.oldcourses.search',
                'method' => 'GET',
                'class' => 'row align-items-center search'
            ]) !!}
                <div class="col"></div>
                <div class="col-md-3">
                    {!! Form::label('keyword', 'کلمه کلیدی') !!}
                    {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'دنبال چی میگردی...']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('department', 'دپارتمان') !!}
                    {!! Form::select('department', App\Department::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'لطفا انتخاب کنید']) !!}
                </div>
                <div class="col-md-3">
                    @php
                        $years = Collect(['1397', '1396', '1395', '1394', '1393', '1392', '1391', '1390', '1389', '1388']);
                    @endphp
                    {!! Form::label('year', 'سال') !!}
                    {!! Form::select('year', $years, null, ['class' => 'form-control', 'placeholder' => 'لطفا انتخاب کنید']) !!}
                </div>
                <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    {!! Form::submit('جستجو کن', ['class' => 'btn btn-block btn-warning']) !!}
                </div>
                <div class="col"></div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-3">
                    @include('site.aboutsidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($courses as $item)
                        <div class="col-md-6">
                            <div class="card single">
                                <div class="card-header">
                                    <i class="fal fa-book"></i>
                                    <strong>{{ $item->title }}</strong>
                                </div>
                                <div class="card-body">
                                    <img src="{{ $item->image1_url }}" alt="{{ $item->title }}" class="img-fluid">
                                    <div class="row">
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image1_url }}">
                                                <img src="{{ $item->thumb1_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @if ($item->image2_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image2_url }}">
                                                <img src="{{ $item->thumb2_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image3_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image3_url }}">
                                                <img src="{{ $item->thumb3_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image4_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image4_url }}">
                                                <img src="{{ $item->thumb4_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image5_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image5_url }}">
                                                <img src="{{ $item->thumb5_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image6_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image6_url }}">
                                                <img src="{{ $item->thumb6_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image7_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image7_url }}">
                                                <img src="{{ $item->thumb7_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image8_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image8_url }}">
                                                <img src="{{ $item->thumb8_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image9_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image9_url }}">
                                                <img src="{{ $item->thumb9_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($item->image10_url)
                                        <div class="col-md-2h">
                                            <a data-fancybox="gallery{{ $item->id }}" href="{{ $item->image10_url }}">
                                                <img src="{{ $item->thumb10_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <ul>
                                        <li>
                                            <i class="fal fa-clock"></i>
                                            {{ $item->start_year }}/{{ $item->start_month }}/{{ $item->start_day }}
                                        </li>
                                        <li>
                                            <i class="fal fa-tag"></i>
                                            @if ($item->department) {{ $item->department->title }} @else تعریف نشده @endif
                                        </li>
                                        <li>
                                            <i class="fal fa-user"></i>
                                            {{ $item->students }} دانشجو
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{ $courses->render() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('oldcourses') }}">
<meta name="keywords" content="{{ Seo::key('oldcourses') }}">
<meta property="og:description" content="{{ Seo::desc('oldcourses') }}">
<meta property="og:image" content="{{ Seo::image('oldcourses') }}">
@endsection