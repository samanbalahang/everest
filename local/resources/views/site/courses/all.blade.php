@extends('site.layouts.main')
@section('title')
    لیست کل دوره ها
@endsection
@section('main')
    <main class="courses">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.courses.index') }}">
                        دوره ها
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('site.courses.all') }}">
                        لیست کل دوره ها
                    </a>
                </li>
            </ul>
            @if (Banner::get('courses'))
            <div class="banner-alt">
                {!! Banner::get('courses') !!}
            </div>
            @endif
            {!! Form::model($search, [
                'route' => 'site.courses.search',
                'method' => 'GET',
                'class' => 'row align-items-center search'
            ]) !!}
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    {!! Form::label('keyword', 'جستجو در دوره ها') !!}
                    {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'نام دوره یا کلاس مورد نظر خود را وارد کنید...']) !!}
                </div>
                <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    {!! Form::submit('جستجو کن', ['class' => 'btn btn-block btn-warning']) !!}
                </div>
            {!! Form::close() !!}
            <p><br></p>
            <p class="text-center">
                تعداد کل دوره ها <strong class="mainColor fs1-5">{{ App\Course::all()->count() }}</strong> دوره
            </p>
            <div class="row">
                @foreach ($departments as $dep)
                <div class="col-12">
                    <div class="section-head">
                        <h2>
                            <i class="fal fa-briefcase"></i>
                            {{ $dep->title }}
                        </h2>
                    </div>
                    <div class="row">
                        @php
                            $courses = App\Course::where('department_id', $dep->id)->get();
                        @endphp
                        @foreach ($courses as $item)
                        <div class="col-md-6">
                            <div class="card single">
                                <div class="card-body">
                                    <a href="{{ route('site.courses.show', $item->slug) }}">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
                                            </div>
                                            <div class="col-9">
                                                <h2>{{ $item->title }}</h2>
                                                <h3>{{ $item->title_en }}</h3>
                                                <h4>شرکت {{ $item->company }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('courses') }}">
<meta name="keywords" content="{{ Seo::key('courses') }}">
<meta property="og:description" content="{{ Seo::desc('courses') }}">
<meta property="og:image" content="{{ Seo::image('courses') }}">
@endsection