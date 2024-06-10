<div class="card catsList hidden-xs">
    <div class="card-header">
        <strong>دسته بندی</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($cats as $item)
            <li>
                <a href="{{ route('site.articles.category', $item->slug) }}">
                    <strong>
                        <i class="fal fa-angle-double-left"></i>
                        {{ $item->title }}
                    </strong>
                    <span>{{ $item->articles->count() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="card catsList">
    <div class="card-header">
        <strong>مقالات منتخب</strong>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($featured as $item)
            <li>
                <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}">
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