@extends('site.layouts.main')
@section('title')
    خانه
@endsection
@section('main')
<main class="home">
    <h1 class="d-none">{{ Setting::get('site_title') }}</h1>
    <section class="sliders">
        @foreach ($sliders as $item)
        <div class="slide" style="background-image: url({{ $item->image_url }});"></div>
        @endforeach
    </section>
    <section class="departments">
        <div class="container">
            <h2 class="title">
                <span>دپارتمان های</span>
                کالج اورست
            </h2>
            <p>{!! Setting::get('home_departments') !!}</p>
            <div class="departmentSlider">
                @foreach ($departments as $item)
                <div class="slide">
                    <div class="departmentSingle">
                        <a href="{{ route('site.courses.department', $item->slug) }}">
                            <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
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
    </section>
    <section class="courses">
        <div class="container">
            <h2 class="title">
                <span>برخی از</span>
                دوره های ما
            </h2>
            <p>{!! Setting::get('home_courses') !!}</p>
            <div class="row align-items-center courseSlider">
                @foreach ($courses as $item)
                <div class="col-md-3 col-12">
                    <div class="courseSingle">
                        <a href="{{ route('site.courses.show', $item->slug) }}">
                            <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
                        </a>
                        <div class="text">
                            <a href="{{ route('site.courses.show', $item->slug) }}">
                                <h4>{{ $item->title }}</h4>
                            </a>
                            <p>{{ $item->title_en }}</p>
                            <a href="{{ route('site.courses.show', $item->slug) }}">
                                مشاهده دوره
                                <i class="fal fa-angle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('site.courses.index') }}" class="btn btnStroke">
                    مشاهده لیست دوره های بیشتر...
                </a>
            </div>
        </div>
    </section>
    <section class="students">
        <div class="container">
            <h3 class="title">
                <span>برخی از</span>
                دانشجویان مشغول به کار
            </h3>
            <p>{!! Setting::get('home_students') !!}</p>
            <div class="row courseSlider">
                @foreach ($students as $item)
                <div class="col-md-3 col-12">
                    <div class="studentSingle">
                        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="img-fluid">
                        <h5>{{ $item->name }}</h5>
                        <ul>
                            <li>
                                تاریخ عضویت : {{ $item->year }}
                            </li>
                            <li>
                                <strong>دوره های گذرانده شده :</strong>
                                <p>
                                    {{ $item->courses }}
                                </p>
                            </li>
                            <li>
                                <strong>شرکت استخدام شده :</strong>
                                <span>{{ $item->company }}</span>
                            </li>
                            <li>
                                <strong>سمت شغلی :</strong>
                                <span>{{ $item->headline }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('site.students') }}" class="btn btnStroke">
                    مشاهده لیست بیشتر...
                </a>
            </div>
        </div>
    </section>
    <section class="lecturers">
        <div class="container">
            <h2 class="title">
                <span>برخی از</span>
                اساتید برتر
            </h2>
            <p>{!! Setting::get('home_lecturers') !!}</p>
            <div class="row courseSlider">
                @foreach ($lecturers as $item)
                <div class="col-md-2h col-12">
                    <div class="lecturerSingle">
                        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="img-fluid">
                        <h4>{{ $item->name }}</h4>
                        <div class="years">
                            <strong>{{ $item->year }}</strong>
                            <span>سال سابقه</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('site.lecturers') }}" class="btn btnStroke">
                    لیست کل اساتید
                </a>
            </div>
        </div>
    </section>
    <section class="news">
        <div class="container">
            <h3 class="title">
                <span>جدیدترین</span>
                اخبار
            </h3>
            <p>{!! Setting::get('home_news') !!}</p>
            <div class="row hidden-xs">
                @foreach ($news as $item)
                <div class="col-md-6">
                    <div class="newsSingle">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                    <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
                                </a>
                                @php
                                    $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                    $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                    $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                    $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                @endphp
                                <div class="date">
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </div>
                            </div>
                            <div class="col-8">
                                <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                                    <h5>{{ $item->title }}</h5>
                                </a>
                                <p>{{ $item->desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="visible-xs">
                <ul class="newsList">
                    @foreach ($news as $item)
                    @php
                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                    @endphp
                    <li>
                        <a href="{{ route('site.news.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                            <strong>{{ $item->title }}</strong>
                            <span>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
                <a href="{{ route('site.news.index') }}" class="btn btnStroke">
                    لیست کل اخبار
                </a>
            </div>
        </div>
    </section>
    <section class="articles">
        <div class="container">
            <h3 class="title">
                <span>جدیدترین</span>
                مقاله ها
            </h3>
            <p>{!! Setting::get('home_articles') !!}</p>
            <div class="row articleSlider">
                @foreach ($articles as $item)
                <div class="col-md-4 col-12">
                    <div class="articleSingle">
                        <img src="{{ $item->thumb_url }}" alt="{{ $item->title }}" class="img-fluid">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->desc }}</p>
                        <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
                            ادامه مقاله...
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('site.articles.index') }}" class="btn btnStroke">
                    لیست کل مقالات
                </a>
            </div>
        </div>
    </section>
    <section class="customers">
        <div class="container">
            <h2 class="title">
                <span>برخی از</span>
                مشتریان کالج اورست
            </h2>
            <p>{!! Setting::get('home_customers') !!}</p>
            <div class="customerSilder">
                @foreach ($customers as $item)
                <div class="customerSlide">
                    <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" title="{{ $item->name }}" class="img-fluid">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="latest">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>
                                <i class="fal fa-bell"></i>
                                جدیدترین مقالات
                            </h4>
                            <ul>
                                @foreach ($articles2 as $item)
                                <li>
                                    <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" title="{{ $item->title }}">
                                        <h5>{{ $item->title }}</h5>
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                        <span>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                <i class="fal fa-bell"></i>
                                جدیدترین فایل های دانلودی
                            </h4>
                            <ul>
                                @foreach ($downloads as $item)
                                <li>
                                    <a href="{{ route('site.downloads.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" title="{{ $item->title }}">
                                        <h5>{{ $item->title }}</h5>
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                        <span>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>
                                <i class="fal fa-bell"></i>
                                جدیدترین آگهی های استخدام
                            </h4>
                            <ul>
                                @foreach ($jobs as $item)
                                <li>
                                    <a href="{{ route('site.jobs.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" title="{{ $item->title }}">
                                        <h5>{{ $item->title }}</h5>
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                        <span>{{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('seo')
<meta name="description" content="{{ Seo::desc('home') }}">
<meta name="keywords" content="{{ Seo::key('home') }}">
<meta property="og:description" content="{{ Seo::desc('home') }}">
<meta property="og:image" content="{{ Seo::image('home') }}">
<meta property="og:type" content="website">
@endsection