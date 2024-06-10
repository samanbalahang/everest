@extends('site.layouts.main')
@section('title')
    دوره ها
@endsection
@section('main')
    <main class="departments">
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
                <a href="{{ route('site.courses.all') }}" class="btn btn-sm btnPrimary">مشاهده کل دوره ها</a>
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="section-head">
                        <h1>
                            دپارتمان های کالج اورست
                        </h1>
                    </div>
                </div>
                @foreach ($departments as $item)
                <div class="col-md-3 col-6">
                    <div class="card single">
                        <a href="{{ route('site.courses.department', $item->slug) }}">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid">
                        </a>
                        <a href="{{ route('site.courses.department', $item->slug) }}">
                            <h4>{{ $item->title }}</h4>
                        </a>
                        <a href="{{ route('site.courses.department', $item->slug) }}" class="link">
                            مشاهده لیست دوره ها
                            <i class="fal fa-angle-left"></i>
                        </a>
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