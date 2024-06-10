<div class="card catsList">
    <div class="card-header">
        <strong>دسته بندی</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($cats as $item)
            <li>
                <a href="{{ route('site.downloads.category', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                    <span>{{ $item->downloads->count() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card catsList hidden-xs">
    <div class="card-header">
        <strong>بیشترین دانلود ها</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($mostDownload as $item)
            <li>
                <a href="{{ route('site.downloads.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
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