@extends('site.layouts.main')
@section('title')
    دپارتمان {{ $department->title }}
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
                    <a href="{{ route('site.courses.department', $department->slug) }}">
                        {{ $department->title }}
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
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="title">
                        <span>دپارتمان</span> {{ $department->title }}
                    </h1>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <img src="{{ $department->image_url }}" alt="{{ $department->title }}" class="img-fluid">
                </div>
            </div>
            <br>
            @if ($courses->count() > 0)
            <div class="row">
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
            @else
                <div class="alert alert-warning">
                    دوره ای یافت نشد!
                </div>
            @endif
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="دپارتمان {{ $department->title }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="دپارتمان {{ $department->title }}, {{ Seo::key('default') }}">
<meta property="og:description" content="دپارتمان {{ $department->title }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ $department->image_url }}">
@endsection