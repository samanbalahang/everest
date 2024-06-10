@extends('panel.layouts.main')
@section('title')
   لیست سیگنال های ثبت شده
@endsection
@section('main')
    <link rel="stylesheet" href="{{asset('/assets/css/datatables.min.css')}}">
    <style>
        .w-200{
            width: 200% !important;
        }
    </style>
    <div class="text-right">
        <!-- <a href="{{route('admin.karbaran.create')}}" class="btn btn-success">
            افزودن
        </a> -->
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @php
        $moshaveehDate = "";
    @endphp
    @if ($users->count() > 0)
    <div class="table-responsive">
        <table id="zero_config" class="table table-inverse table-striped table-bordered w-200">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام
                            نام خانوادگی</th>
                        <th>
                            ثبت کننده
                        </th>    
                        <th>موبایل</th>
                        <td>منطقه</td>
                        <td>جنسیت</td>
                        <td>سن</td>
                        <td>آشنایی</td>
                        <td>سرنخ</td>
                        <th>تاریخ ثبت</th>
                        <th>تاریخ مشاوره</th>
                        <th>
                            دوره
                        </th>
                        <th>
                            درخواست
                        </th>

                        <th>وضعیت</th>
                        <td>
                            توضیح مشاور
                        </td>
                        <td>
                           مهارت فعلی
                        </td>
                        <td>
                           هدف
                        </td>
                        <td>
                           نیازمندی کاربر در مشاوره
                        </td>
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @if($users->count() >0)
                    @foreach ($users as $item) 
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                       {{ $item->fname }} {{ $item->lname }}    
                        </td>
                        <td>
                            @if(App\Kaebaran::find($item->karbar_id))
                            {{App\Kaebaran::find($item->karbar_id)->karbar_lname}}-{{App\Kaebaran::find($item->karbar_id)->karbar_phone}}
                            @endif
                        </td>
                        <td>{{ $item->mobile }}</td>
                        <td>
                            @if(App\Area::find($item->area))
                            {{App\Area::find($item->area)->area}}
                            @else
                            {{$item->area}}
                            @endif
                        </td>
                        <td>
                            @switch($item->gender)
                            @case(null)
                            {{__("")}}
                            @break
                            @case(0)
                            {{__("زن")}}
                            @break
                            @case(1)
                            {{__("مرد")}}
                            @break
                            @endswitch
                        </td>
                        <td>
                            {{ $item->Age }}
                        </td>
                        <td>
                            @if(App\Ashnaee::find($item->method_id))
                            {{App\Ashnaee::find($item->method_id)->title}}
                            @endif
                        </td>
                        <td>
                            @if(App\Sarnakh::find($item->method_id))
                            {{App\Sarnakh::find($item->lead)->title}}
                            @endif
                        </td>
                        <td>
                            @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->usersignalcreated_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->usersignalcreated_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->usersignalcreated_at)->day;
                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                            @endphp
                            {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                        </td>
                        <td>
                            @php
                            $moshavers = App\signalmoshaver::where("user_signal_id",$item->usersignalId)->where("signal_id",$item->signalid)->first();
                            @endphp
                            @if($moshavers)
                            @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $moshavers->updated_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $moshavers->updated_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $moshavers->updated_at)->day;
                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                            @endphp
                            {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                            @endif
                            <br>
                        </td>
                        <td>
                            {{App\Doreha::find($item->course_id)->title}}
                        </td>
                        <td>
                            {{$item->signalsrequest}}
                        </td>
                        <td>
                          
                            @if($moshavers!= null)
                                @if($moshavers->vazeiat)
                                    {{$moshavers->vazeiat}}
                                    @else
                                    {{__("مشاوره نشده")}}
                                @endif
                            @else
                                {{__("مشاوره نشده")}}
                            @endif
                        </td>
                        <td>
                            @if($moshavers!= null)
                             {{$moshavers->tozih}}
                            @endif
                        </td>
                        <td>
                            @if($moshavers!= null)
                             {{$moshavers->maharat}}
                            @endif
                        </td>
                        <td>
                            @if($moshavers!= null)
                             {{$moshavers->hadaf}}
                            @endif
                        </td>
                        <td>
                            @if($moshavers!= null)
                             {{$moshavers->naiz}}
                            @endif
                        </td>
                        <td>
                           <a href="{{route("site.signal.moshaver",$item->usersignalId)}}" class="btn btn-dark">
                           <i class="fa fa-eye"></i>
                            </a>
                                <a href="{{route('site.signal.create',"mobile=".$item->mobile)}}" class="btn btn-warning">
                                 <i class="fa fa-edit"></i>
                                </a>
                        </td>
                    </tr>
                        @php
                        $i++;
                        @endphp
                    @endforeach
                    @endif
                </tbody>
            </table>
    </div>
    @else
    <div class="alert alert-warning">
       سیگنالی ثبت نشده است.
    </div>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('/assets/js/datatables.min.js')}}"></script>
    <script>
        new DataTable('#zero_config', {
            layout: {
                topStart: {
                    buttons: [
                        'excel'
                    ]
                }
            }
        });
    </script>
@endsection