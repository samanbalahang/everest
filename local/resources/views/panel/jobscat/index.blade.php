@extends('panel.layouts.main')
@section('title')
    دسته بندی آگهی‌های استخدام
@endsection
@section('main')
    <div class="text-right">
        <a href="{{ route('admin.jobscat.create') }}" class="btn btn-success">
            افزودن
        </a>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary">
            آگهی‌های استخدام
        </a>
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($jobscat->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تیتر</th>
                    <th>نشانی</th>
                    <th>آگهی‌ها</th>
                    <th>بازدید</th>
                    <th>تاریخ</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($jobscat as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->jobs->count() }} آگهی</td>
                    <td>{{ $item->views }} بازدید</td>
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.jobscat.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('site.jobs.category', $item->slug) }}" class="btn btn-dark" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.jobscat.edit', $item->id) }}" class="btn btn-primary">
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
        دسته‌بندی ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection