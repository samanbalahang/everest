@extends('panel.layouts.main')
@section('title')
    منو
@endsection
@section('main')
    <div class="text-right">
        <a href="{{ route('admin.menu.create') }}" class="btn btn-success">
            افزودن
        </a>
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($menu->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>لینک</th>
                    <th>موقعیت</th>
                    <th>مادر</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($menu as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->link }}</td>
                    <td>{{ $item->menuPos->title }}</td>
                    <td>{{ $item->parent }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.menu.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-primary">
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
                @if ($item->subs)
                    @foreach ($item->subs as $sub)
                    <tr>
                        <td>{{ $i }}</td>
                        <td> - {{ $sub->title }}</td>
                        <td>{{ $sub->link }}</td>
                        <td>{{ $sub->menuPos->title }}</td>
                        <td>{{ $sub->parent }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.menu.destroy', $sub->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                            <a href="{{ route('admin.menu.edit', $sub->id) }}" class="btn btn-primary">
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
                    @if ($sub->subs)
                        @foreach ($sub->subs as $isub)
                        <tr>
                            <td>{{ $i }}</td>
                            <td> -- {{ $isub->title }}</td>
                            <td>{{ $isub->link }}</td>
                            <td>{{ $isub->menuPos->title }}</td>
                            <td>{{ $isub->parent }}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.menu.destroy', $isub->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                                <a href="{{ route('admin.menu.edit', $isub->id) }}" class="btn btn-primary">
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
                    @endif
                    @endforeach
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-warning">
        منو تعریف نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection