@extends('panel.layouts.main')
@section('title')
    تنظیمات سئو
@endsection
@section('main')
    @if (Auth::user()->email == 'laravel@arya.agency')
    <div class="text-right">
        <a href="{{ route('admin.seo.create') }}" class="btn btn-success">
            افزودن
        </a>
    </div>
    <br>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($seo->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>صفحه مربوطه</th>
                    <th>کلمات کلیدی</th>
                    <th>توضیحات</th>
                    <th>تصویر</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($seo as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->label }}</td>
                    <td>{{ $item->keywords }}</td>
                    <td>{{ $item->description }}</td>
                    <td><img src="{{ $item->image_url }}" width="40"></td>
                    <td>
                        @if (Auth::user()->email == 'laravel@arya.agency')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.seo.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('admin.seo.edit', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                        @else
                        <a href="{{ route('admin.seo.edit', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endif
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
        تنظیماتی ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection