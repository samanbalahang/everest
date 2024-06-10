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
    @if ($newsletters->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>شماره همراه</th>
                    <th>تاریخ</th>
                    <th width="40"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($newsletters as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->mobile }}</td>
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.newsletters.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
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
        درخواست مشاوره ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection