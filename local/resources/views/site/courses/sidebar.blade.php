<div class="card catsList">
    <div class="card-header">
        <strong>دوره های مشابه</strong>
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
<div class="card catsList">
    <div class="card-header">
        <strong>آگهی های استخدام مشابه</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($jobs as $item)
            <li>
                <a href="{{ route('site.jobs.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
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