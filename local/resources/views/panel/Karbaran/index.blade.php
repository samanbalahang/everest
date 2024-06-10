@extends('panel.layouts.main')
@section('title')
    لیست کاربران سایت
@endsection
@section('main')
    <div class="text-right">
        <a href="{{route('admin.karbaran.create')}}" class="btn btn-success">
            افزودن
        </a>
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($karbaran))
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th> نام کاربر</th>
                    <th> نام خانوادگی</th>
                    <th>تلفن کاربر</th>
                    <th>نقش کاربری</th>
                    <th>فعال</th>
                    <th width="120"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($karbaran as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->karbar_name }}</td>
                    <td>{{$item->karbar_lname}}</td>
                    <td>{{$item->karbar_phone}}</td>
                    <td>
                    @switch($item->karbar_role)
                        @case(0)
                            {{__("ثبت سیگنال")}}
                            @break
                        @case(1)
                            {{__("مشاهدگر سیگنال")}} 
                            @break
                        @case(2)
                            {{__("مشاور")}}
                            @break
                    @endswitch    
                    </td>
                    <td>
                        @if($item->active ==0)
                            {{__("غیر فعال")}}
                        @else
                            {{__("فعال")}}
                        @endif        
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.karbaran.destroy', $item->id], 'onsubmit' => "return confirm('آیا برای حذف مطمئن هستید؟');"]) !!}
                        <!-- <a href="{{ route('admin.karbaran.show', ['id' => $item->id, 'title' => str_replace(" ", "-", $item->title)]) }}" class="btn btn-dark" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a> -->
                        <a href="{{ route('admin.karbaran.edit', $item->id) }}" class="btn btn-primary">
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
        کاربر ثبت نشده است!
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $("#zero_config").DataTable();
    </script>
@endsection