<div class="card catsList hidden-xs">
    <div class="card-header">
        <strong>دسته بندی</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($cats as $item)
            <li>
                <a href="{{ route('site.jobs.category', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card catsList">
    <div class="card-header">
        <strong>آخرین دوره ها</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($courses as $item)
            <li>
                <a href="{{ route('site.courses.show', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>