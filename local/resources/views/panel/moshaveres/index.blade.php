@extends('panel.layouts.main')
@section('title')
    درخواست مشاوره
@endsection
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($moshaveres->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>شماره همراه</th>
                    <th>نحوه آشنایی</th>
                    <th>علاقه‌مندی</th>
                    <th>تاریخ</th>
                    <th>منبع</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($moshaveres as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>@if(isset($item->method)){{$item->method->title}}@else{{" "}}@endif</td>
                    <td>{!! $item->fav !!}</td>
                    <td>
                        @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->day;
                            $hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->hour;
                            $minutes = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->minute;
                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                        @endphp
                        {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }} <br>
                        {{ $hour }}:{{ $minutes }}
                    </td>
                    <td>{{ $item->source }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.moshaveres.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
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
        درخواست مشاوره دریافت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection