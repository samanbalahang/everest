@extends('panel.layouts.main')
@section('title')
    مقالات
@endsection
@section('main')
    <div class="text-right">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success">
            افزودن
        </a>
        <a href="{{ route('admin.articlescat.index') }}" class="btn btn-primary">
            دسته بندی
        </a>
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($articles->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>تیتر</th>
                    <th>موضوع</th>
                    <th>بازدید</th>
                    <th>ویژه</th>
                    <th>تاریخ</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($articles as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td><img src="{{ $item->image_url }}" width="60"></td>
                    <td>{{ $item->title }}</td>
                    <td>@if ($item->articleCat) {{ $item->articleCat->title }} @else بدون دسته بندی @endif</td>
                    <td>{{ $item->views }} بازدید</td>
                    <td>
                    @if ($item->featured == 'no')
                        خیر
                    @else
                        بله
                    @endif
                    </td>
                    <td>
                        @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                        @endphp
                        {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.articles.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('site.articles.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="btn btn-dark" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.articles.edit', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning">
        مقاله‌ای ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection