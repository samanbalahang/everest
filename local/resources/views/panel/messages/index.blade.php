@extends('panel.layouts.main')
@section('title')
    پیام های دریافتی
@endsection
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($messages->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>شماره همراه</th>
                    <th>ضمیمه</th>
                    <th>وضعیت</th>
                    <th>تاریخ</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($messages as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>@if ($item->mobile) {{ $item->mobile }} @else وارد نشده است @endif</td>
                    <td>@if ($item->file_url) دارد @else ندارد @endif</td>
                    <td>@if ($item->seen == 0) <span class="badge badge-success">جدید</span> @else خوانده شده @endif</td>
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.messages.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('admin.messages.show', $item->id) }}" class="btn btn-dark">
                            <i class="fa fa-eye"></i>
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
        پیامی دریافت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection