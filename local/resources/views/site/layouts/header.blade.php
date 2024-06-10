<header>
    @if (Setting::get('sub_header'))
    <div class="subHeader">
        <div class="container">
            <p>
                {!! Setting::get('sub_header') !!}
            </p>
        </div>
    </div>
    @endif
    <div class="topHeader">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-6">
                    <span class="showMenuMobile visible-xs">
                        <i class="fal fa-bars"></i>
                    </span>
                    <nav>
                        <ul class="menu hidden-xs">
                            @php
                                $route = Route::currentRouteName();
                            @endphp
                            <li class="@if ($route == 'site.home') active @endif">
                                <a href="{{ route('site.home') }}">
                                    صفحه اصلی
                                </a>
                            </li>
                            <li class="@if ($route == 'site.courses.index' || $route == 'site.courses.department' || $route == 'site.courses.show' || $route == 'site.courses.search') active @endif">
                                <a href="{{ route('site.courses.index') }}">
                                    دوره‌ها
                                </a>
                            </li>
                            <li class="@if ($route == 'site.articles.index' || $route == 'site.articles.show' || $route == 'site.articles.category') active @endif">
                                <a href="{{ route('site.articles.index') }}">
                                    مقالات آموزشی
                                </a>
                            </li>
                            <li class="@if ($route == 'site.downloads.index' || $route == 'site.downloads.show' || $route == 'site.downloads.category') active @endif">
                                <a href="{{ route('site.downloads.index') }}">
                                    دانلودها
                                </a>
                            </li>
                            <li class="@if ($route == 'site.news.index' || $route == 'site.news.show') active @endif">
                                <a href="{{ route('site.news.index') }}">
                                    اخبار
                                </a>
                            </li>
                            <li class="@if ($route == 'site.jobs.index' || $route == 'site.jobs.show' || $route == 'site.jobs.category') active @endif">
                                <a href="{{ route('site.jobs.index') }}">
                                    آگهی‌های استخدام
                                </a>
                            </li>
                            <li class="@if ($route == 'site.moshavere') active @endif">
                                <a href="{{ route('site.moshavere') }}">
                                    درخواست مشاوره
                                </a>
                            </li>
                            <li class="@if ($route == 'site.contact') active @endif">
                                <a href="{{ route('site.contact') }}">
                                    تماس با ما
                                </a>
                            </li>
                            <li class="@if ($route == 'site.about' || $route == 'site.aboutin') active @endif has-child hidden-xs">
                                <a href="{{ route('site.about') }}">
                                    درباره ما
                                </a>
                                <ul class="child">
                                    <li>
                                        <a href="{{ route('site.customers') }}">
                                            مشتریان سازمانی
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.lecturers') }}">
                                            اساتید
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.oldcourses.index') }}">
                                            دوره‌های برگزار شده
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.testimonials.index') }}">
                                            نظرات دانشجویان
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.students') }}">
                                            دانشجویان مشغول به کار شده
                                        </a>
                                    </li>
                                    @php
                                        $abouts = App\About::where('slug', '!=', 'about')->get();
                                    @endphp
                                    @foreach ($abouts as $item)
                                    <li>
                                        <a href="{{ route('site.aboutin', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="has-child visible-xs">
                                <a>
                                    درباره ما
                                </a>
                                <ul class="child">
                                    <li>
                                        <a href="{{ route('site.customers') }}">
                                            مشتریان سازمانی
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.lecturers') }}">
                                            اساتید
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.oldcourses.index') }}">
                                            دوره‌های برگزار شده
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.testimonials.index') }}">
                                            نظرات دانشجویان
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.students') }}">
                                            دانشجویان مشغول به کار شده
                                        </a>
                                    </li>
                                    @php
                                        $abouts = App\About::where('slug', '!=', 'about')->get();
                                    @endphp
                                    @foreach ($abouts as $item)
                                    <li>
                                        <a href="{{ route('site.aboutin', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3 col-6">
                    <ul class="social">
                        @if (Setting::get('googleplus'))
                        <li>
                            <a href="{{ Setting::get('googleplus') }}">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('youtube'))
                        <li>
                            <a href="{{ Setting::get('youtube') }}">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('linkedin'))
                        <li>
                            <a href="{{ Setting::get('linkedin') }}">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('twitter'))
                        <li>
                            <a href="{{ Setting::get('twitter') }}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('facebook'))
                        <li>
                            <a href="{{ Setting::get('facebook') }}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mainHeader">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <a href="{{ route('site.home') }}" class="logo">
                        <img src="@if (Setting::get('logo')) {{ Setting::get('logo') }} @else {{ asset('images/logo.png') }} @endif" alt="{{ Setting::get('site_title') }}" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-7">
                    <form action="{{ route('site.search') }}" class="searchForm">
                        <input type="text" name="keyword" placeholder="جست و جو" />
                        <button type="submit">
                            <i class="fal fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mainMenu">
            <span class="menuShow visible-xs">
                <i class="fal fa-bars"></i>
                مشاهده دوره ها
            </span>
            <ul class="menuCourse">
                @php
                    $menu = App\MenuPos::where('slug', 'menu_main')->first();
                    if ($menu) {
                        $menus = $menu->menus->where('parent_id', 0);
                    }
                @endphp
                @if ($menu)
                @foreach ($menus as $item)
                <li>
                    <a @if ($item->link != "none") href="{{ $item->link }}" @elseif ($item->subs) onclick="showMegaMenu({{ $item->id }})" @endif>
                        {{ $item->title }}
                        @if ($item->subs)
                        <i class="fal fa-angle-down"></i>
                        @endif
                    </a>
                    @if ($item->subs)
                    <div class="megaMenu" data-id="{{ $item->id }}" style="background-image:url('{{ asset($item->thumb_url) }}')">
                        <ul>
                            @foreach ($item->subs as $sub)
                            <li>
                                <a @if ($sub->link != "none") href="{{ $sub->link }} @endif">
                                    {{ $sub->title }}
                                </a>
                                @if ($sub->subs)
                                <ul>
                                @foreach ($sub->subs as $isub)
                                    <li>
                                        <a @if ($isub->link != "none") href="{{ $isub->link }}" @endif>
                                            <i class="fal fa-angle-left"></i>
                                            {{ $isub->title }}
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</header>