<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @php
                    $route = Route::currentRouteName();
                @endphp
                <li>
                    <br>
                </li>
                <li class="sidebar-item @if($route == 'admin.dashboard') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <i class="icon-Dashboard"></i>
                        <span class="hide-menu">داشبورد </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">مشاوره</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.favs.index' || $route == 'admin.favs.create' || $route == 'admin.favs.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.favs.index') }}" aria-expanded="false">
                        <i class="icon-Heart"></i>
                        <span class="hide-menu">علاقه‌مندی</span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.methods.index' || $route == 'admin.methods.create' || $route == 'admin.methods.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.methods.index') }}" aria-expanded="false">
                        <i class="icon-Search-People"></i>
                        <span class="hide-menu">نحوه آشنایی</span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.moshaveres.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.moshaveres.index') }}" aria-expanded="false">
                        <i class="icon-Envelope"></i>
                        <span class="hide-menu">درخواست</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">دانشجویان</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.students.index' || $route == 'admin.students.create' || $route == 'admin.students.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.students.index') }}" aria-expanded="false">
                        <i class="icon-Student-Male"></i>
                        <span class="hide-menu">دانشجویان شاغل </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.testimonials.index' || $route == 'admin.testimonials.create' || $route == 'admin.testimonials.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.testimonials.index') }}" aria-expanded="false">
                        <i class="icon-Love-User"></i>
                        <span class="hide-menu">ویدئوهای نظرات </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">اخبار، مقالات و دانلود</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.news.index' || $route == 'admin.news.create' || $route == 'admin.news.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.news.index') }}" aria-expanded="false">
                        <i class="icon-File"></i>
                        <span class="hide-menu">اخبار </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.articles.index' || $route == 'admin.articles.create' || $route == 'admin.articles.edit' || $route == 'admin.articlescat.index' || $route == 'admin.articlescat.create' || $route == 'admin.articlescat.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.articles.index') }}" aria-expanded="false">
                        <i class="icon-Book"></i>
                        <span class="hide-menu">مقالات </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.downloads.index' || $route == 'admin.downloads.create' || $route == 'admin.downloads.edit' || $route == 'admin.downloadscat.index' || $route == 'admin.downloadscat.create' || $route == 'admin.downloadscat.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.downloads.index') }}" aria-expanded="false">
                        <i class="icon-Download-fromCloud"></i>
                        <span class="hide-menu">دانلودها </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">دوره‌ها</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.departments.index' || $route == 'admin.departments.create' || $route == 'admin.departments.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.departments.index') }}" aria-expanded="false">
                        <i class="icon-Optimization"></i>
                        <span class="hide-menu">دپارتمان‌ها </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.courses.index' || $route == 'admin.courses.create' || $route == 'admin.courses.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.courses.index') }}" aria-expanded="false">
                        <i class="icon-Chemical"></i>
                        <span class="hide-menu">دوره‌ها </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.oldcourses.index' || $route == 'admin.oldcourses.create' || $route == 'admin.oldcourses.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.oldcourses.index') }}" aria-expanded="false">
                        <i class="icon-Chemical-2"></i>
                        <span class="hide-menu">دوره‌های برگزار شده </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">سایر بخش‌ها</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.lecturers.index' || $route == 'admin.lecturers.create' || $route == 'admin.lecturers.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.lecturers.index') }}" aria-expanded="false">
                        <i class="icon-Professor"></i>
                        <span class="hide-menu">اساتید </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.customers.index' || $route == 'admin.customers.create' || $route == 'admin.customers.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.customers.index') }}" aria-expanded="false">
                        <i class="icon-Worker"></i>
                        <span class="hide-menu">مشتریان </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.jobs.index' || $route == 'admin.jobs.create' || $route == 'admin.jobs.edit' || $route == 'admin.jobscat.index' || $route == 'admin.jobscat.create' || $route == 'admin.jobscat.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.jobs.index') }}" aria-expanded="false">
                        <i class="icon-Suitcase"></i>
                        <span class="hide-menu">آگهی‌های استخدام </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.abouts.index' || $route == 'admin.abouts.create' || $route == 'admin.abouts.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.abouts.index') }}" aria-expanded="false">
                        <i class="icon-Align-Left"></i>
                        <span class="hide-menu">درباره </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.pages.index' || $route == 'admin.pages.create' || $route == 'admin.pages.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.pages.index') }}" aria-expanded="false">
                        <i class="icon-Files"></i>
                        <span class="hide-menu">برگه ها </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">تماس و مشاوره</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.messages.index' || $route == 'admin.messages.show') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.messages.index') }}" aria-expanded="false">
                        <i class="icon-Mailbox-Empty"></i>
                        <span class="hide-menu">پیام‌های دریافتی </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.newsletters.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.newsletters.index') }}" aria-expanded="false">
                        <i class="icon-Mail-3"></i>
                        <span class="hide-menu">درخواست مشاوره </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">تنظیمات سایت</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.menu.index' || $route == 'admin.menu.create' || $route == 'admin.menu.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.menu.index') }}" aria-expanded="false">
                        <i class="icon-Bulleted-List"></i>
                        <span class="hide-menu">منو </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.sliders.index' || $route == 'admin.sliders.create' || $route == 'admin.sliders.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.sliders.index') }}" aria-expanded="false">
                        <i class="icon-Photos"></i>
                        <span class="hide-menu">اسلایدر </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.numbers.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.numbers.index') }}" aria-expanded="false">
                        <i class="icon-Tag"></i>
                        <span class="hide-menu">اعداد </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.banner.index' || $route == 'admin.banner.create' || $route == 'admin.banner.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.banner.index') }}" aria-expanded="false">
                        <i class="icon-Tag-2"></i>
                        <span class="hide-menu">متن بنر </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.settings.index' || $route == 'admin.settings.create' || $route == 'admin.settings.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.settings.index') }}" aria-expanded="false">
                        <i class="icon-Gears"></i>
                        <span class="hide-menu">تنظیمات </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.seo.index' || $route == 'admin.seo.create' || $route == 'admin.seo.edit') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.seo.index') }}" aria-expanded="false">
                        <i class="icon-Gears-2"></i>
                        <span class="hide-menu">تنظیمات سئو </span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">تنظیمات کاربری</span>
                </li>
                <li class="sidebar-item @if($route == 'admin.user.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.user.index') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">تغییر رمز عبور </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.karbaran.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.karbaran.index') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت کاربران </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.doreha.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.doreha.index') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت دوره ها </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.area.list') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.area.list') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت مناطق </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.signal.list') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.signal.list') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت سیگنال ها </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.ashnaee.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.ashnaee.index') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت نحوه آشنایی </span>
                    </a>
                </li>
                <li class="sidebar-item @if($route == 'admin.sarnakh.index') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.sarnakh.index') }}" aria-expanded="false">
                        <i class="icon-User"></i>
                        <span class="hide-menu">مدیریت سرنخ </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>