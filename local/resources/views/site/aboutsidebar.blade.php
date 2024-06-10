<div class="card aboutList">
    <div class="card-header">
        <strong>درباره ما</strong>
    </div>
    <div class="card-body">
        <ul>
            @php
                $route = Route::currentRouteName();
            @endphp
            <li @if ($route == 'site.customers') class="active" @endif>
                <a href="{{ route('site.customers') }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        مشتریان ما
                    </strong>
                </a>
            </li>
            <li @if ($route == 'site.lecturers') class="active" @endif>
                <a href="{{ route('site.lecturers') }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        اساتید
                    </strong>
                </a>
            </li>
            <li @if ($route == 'site.students') class="active" @endif>
                <a href="{{ route('site.students') }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        دانشجویان مشغول به کار شده
                    </strong>
                </a>
            </li>
            <li @if ($route == 'site.oldcourses.index' || $route == 'site.oldcourses.search') class="active" @endif>
                <a href="{{ route('site.oldcourses.index') }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        دوره های برگزار شده
                    </strong>
                </a>
            </li>
            <li @if ($route == 'site.testimonials.index' || $route == 'site.testimonials.show') class="active" @endif>
                <a href="{{ route('site.testimonials.index') }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        نظرات دانشجویان
                    </strong>
                </a>
            </li>
            @php
                $abouts = App\About::where('slug', '!=', 'about')->get();
            @endphp
            @foreach ($abouts as $item)
            @if ($route == 'site.about' || $route == 'site.aboutin')
            <li @if ($about->slug == $item->slug) class="active" @endif>
                <a href="{{ route('site.aboutin', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('site.aboutin', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                </a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>