@extends('panel.layouts.main')
@section('title')
    دانشجویان مشغول به کار
@endsection
@section('main')
    <div class="text-right">
        <a href="{{ route('admin.students.create') }}" class="btn btn-success">
            افزودن
        </a>
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($students->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>نام</th>
                    <th>سال</th>
                    <th>عنوان شغلی</th>
                    <th>شرکت</th>
                    <th>تاریخ</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($students as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td><img src="{{ $item->image_url }}" width="60"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->headline }}</td>
                    <td>{{ $item->company }}</td>
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.students.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('admin.students.edit', $item->id) }}" class="btn btn-primary">
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
        دانشجویی ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection