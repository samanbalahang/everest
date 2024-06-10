@extends('panel.layouts.main')
@section('title')
    تنظیمات
@endsection
@section('main')
    @if (Auth::user()->email == 'laravel@arya.agency')
    <div class="text-right">
        <a href="{{ route('admin.settings.create') }}" class="btn btn-success">
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
    @if ($settings->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>مقدار</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($settings as $item)
                @if ($item->show == 1 || Auth::user()->email == 'laravel@arya.agency')
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->label }}</td>
                    <td>
                        @if ($item->type == 'string' || $item->type == 'radio')
                            @if ($item->value == 'no')
                                خیر
                            @elseif ($item->value == 'yes')
                                بله
                            @else    
                                {{ $item->value }}
                            @endif    
                        @elseif ($item->type == 'file')
                        {{ $item->image_url }}
                        @elseif ($item->type == 'text')
                        {{ $item->text }}
                        @endif    
                    </td>
                    <td>
                        @if (Auth::user()->email == 'laravel@arya.agency')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.settings.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <a href="{{ route('admin.settings.edit', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                        @else
                        <a href="{{ route('admin.settings.edit', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
                @endif
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