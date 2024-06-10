@extends('site.layouts.main')
@section('title')
    نتایج جستجو
@endsection
@section('main')
    <main class="search">
        <section class="hero"></section>
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('site.home') }}">
                        صفحه اصلی
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    جست و جو
                </li>
            </ul>
            @if (Banner::get('search'))
            <div class="banner-alt">
                {!! Banner::get('search') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <p>
                        برای کلمه <strong dir="ltr">«{{ $keyword }}»</strong> <span>{{ $count }}</span> مورد پیدا شد.
                    </p>
                </div>
                <div class="col-md-12">
                    @if (! $count > 0)
                    <div class="alert alert-warning">
                        نتیجه ای یافت نشد!
                    </div>
                    @endif
                    @php
                        $i = 1;
                    @endphp
                    <div class="row">
                        @foreach ($courses as $item)
                        <div class="col-md-12">
                            <a href="{{ route('site.courses.show', $item->slug) }}" class="list-group-item list-group-item-action">
                                <span class="badge badge-primary badge-pill">{{ $i }}</span>
                                <h6 class="d-inline">
                                    {{ $item->title }}
                                </h6><br><br/>
                                <p>
                                    {{ $item->title_en }} - {{ $item->company }}
                                </p>
                                <span>
                                    در <strong>دوره ها</strong>
                                </span>
                            </a>
                            <br>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                        @foreach ($articles as $item)
                        <div class="col-md-12">
                            <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="list-group-item list-group-item-action">
                                <span class="badge badge-primary badge-pill">{{ $i }}</span>
                                <h6 class="d-inline">
                                    {{ $item->title }}
                                </h6><br><br/>
                                <p>
                                    {{ $item->desc }}
                                </p>
                                <span>
                                    در <strong>مقالات</strong>
                                </span>
                            </a>
                            <br>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                        @foreach ($downloads as $item)
                        <div class="col-md-12">
                            <a href="{{ route('site.downloads.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="list-group-item list-group-item-action">
                                <span class="badge badge-primary badge-pill">{{ $i }}</span>
                                <h6 class="d-inline">
                                    {{ $item->title }}
                                </h6><br><br/>
                                <p>
                                    {{ $item->desc }}
                                </p>
                                <span>
                                    در <strong>دانلودها</strong>
                                </span>
                            </a>
                            <br>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                        @foreach ($jobs as $item)
                        <div class="col-md-12">
                            <a href="{{ route('site.jobs.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="list-group-item list-group-item-action">
                                <span class="badge badge-primary badge-pill">{{ $i }}</span>
                                <h6 class="d-inline">
                                    {{ $item->title }}
                                </h6><br><br/>
                                <p>
                                    {{ $item->desc }}
                                </p>
                                <span>
                                    در <strong>آگهی های استخدام</strong>
                                </span>
                            </a>
                            <br>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                        @foreach ($news as $item)
                        <div class="col-md-12">
                            <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="list-group-item list-group-item-action">
                                <span class="badge badge-primary badge-pill">{{ $i }}</span>
                                <h6 class="d-inline">
                                    {{ $item->title }}
                                </h6><br><br/>
                                <p>
                                    {{ $item->desc }}
                                </p>
                                <span>
                                    در <strong>اخبار</strong>
                                </span>
                            </a>
                            <br>
                        </div>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('seo')
<meta name="description" content="{{ $keyword }} - {{ Seo::desc('default') }}">
<meta name="keywords" content="{{ $keyword }}, {{ Seo::key('default') }}">
<meta property="og:description" content="{{ $keyword }} - {{ Seo::desc('default') }}">
<meta property="og:image" content="{{ Seo::image('default') }}">
@endsection