@extends('site.layouts.main')
@section("seo")
<link rel="stylesheet" href="https://uni-everest.com/admin/assets/libs/datatables/datatables.css">
<style>
    body {
        direction: rtl !important;
    }

    main header {
        padding: 1rem 0;
    }

    main header ul {
        list-style: none;
    }

    main header>ul {
        display: flex;
        justify-content: flex-end;
    }

    main nav {
        background-color: #d4e7f5;

    }

    main nav>ul {
        display: flex;
    }

    main header a {
        text-decoration: none;
        color: #626262;
        padding: 1rem;
        display: block;
    }

    #oldsignal div {
        padding: 1rem;
    }

    #oldsignal div:nth-child(odd) {
        background-color: #eff0ff;
    }

    #oldsignal div:nth-child(even) {
        background-color: #d9fde1;
    }

    .mainMenu,
    .mainHeader {
        display: none;
    }

    :focus {
        outline: 0;
        border-color: #2260ff;
        box-shadow: 0 0 0 4px #b5c9fc;
    }

    .mydict div {
        display: flex;
        flex-wrap: wrap;
        margin-top: 0.5rem;
        justify-content: center;
    }

    .mydict input[type="radio"],
    .mydict input[type="checkbox"] {
        clip: rect(0 0 0 0);
        clip-path: inset(100%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }

    .mydict input[type="radio"]:checked+span,
    .mydict input[type="checkbox"]:checked+span {
        box-shadow: 0 0 0 0.0625em #0043ed;
        background-color: #dee7ff;
        z-index: 1;
        color: #0043ed;
    }

    label span {
        display: block;
        cursor: pointer;
        background-color: #fff;
        padding: 0.375em .75em;
        position: relative;
        margin-left: .0625em;
        box-shadow: 0 0 0 0.0625em #b5bfd9;
        letter-spacing: .05em;
        color: #3e4963;
        text-align: center;
        transition: background-color .5s ease;
    }

    label:first-child span {
        border-radius: .375em 0 0 .375em;
    }

    label:last-child span {
        border-radius: 0 .375em .375em 0;
    }

    .rtl {
        direction: rtl !important;
    }

    .bg-orange {
        background-color: orange;
    }

    .bg-subtel-warning {
        background-color: #f3dc98;
    }

    .bg-subtel-orange {
        background-color: #f9c76a;
    }

    .bg-subtel-primary {
        background-color: #87bef9;
    }

    .bg-subtel-success {
        background-color: #9ecfa9;
    }
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
    <header>
        <ul>
            <li>
                <a href="#">
                    <i class="fas fa-user"></i>
                    {{$karbaran->karbar_name}} {{$karbaran->karbar_lname}}
                </a>
            </li>
        </ul>
        <nav>
            <ul>
                <li>
                <li>
                    <a class="text-center rtl" href="{{route('site.signal.amar')}}">
                        آمار
                    </a>
                </li>
                </li>
                <li>
                    <a class="text-center rtl" href="{{route('site.signal.create',"newuser=1")}}">
                        ثبت سیگنال
                    </a>
                </li>
                <li>
                    @switch($karbaran->karbar_role)
                    @case(0)
                    @break
                    @case(1)
                    <a href="{{route("site.signal.list")}}" class="">
                        لیست سیگنال ها
                    </a>
                    @break
                    @case(2)
                    <a href="{{route("site.signal.list")}}" class="">
                        لیست سیگنال ها
                    </a>
                    @break
                    @endswitch
                </li>
                <li class="mr-auto">
                    <a class="text-center rtl" href="{{route('site.signal.login',"newuser=1")}}">
                        خروج:
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container-fluid">
        <h2 class="text-center">
            لیست سیگنالها
        </h2>
        <div class="col-4 mr-auto d-flex flex-wrap border d-inline-block ">
            <p class="p-3 border">
                مشاوره نشده (سفید):
                <span class="p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border">
                درحال بررسی توسط کاربر(زرد):
                <span class="bg-warning p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border">
                منصرف شده (نارنجی):
                <span class="bg-orange p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border">
                قراره بیاید (آبی) :
                <span class="bg-primary p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border">
                ثبت نام کرد (سبز) :
                <span class="bg-success p-1 border d-inline-block"></span>
            </p>
        </div>
        <div class="p-3 d-inline-bloc">

            <table id="zero_config" class="table table-inverse table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام
                            نام خانوادگی</th>
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
                        <th>وضعیت</th>
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @if($users->count() >0)
                    @foreach ($users as $item)
                    @php
                    $signals = App\Signal::where("user_signal_id",$item->id)->get();
                    @endphp

                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                        @foreach($signals as $signal)
                            @php
                                $moshavers = App\signalmoshaver::where("user_signal_id",$item->id)->where("signal_id", $signal->id)->get();
                            @endphp
                            
                            {{ $item->fname }} {{ $item->lname }}
                            <hr>
                        @endforeach    
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
                            @if(App\Method::find($item->method_id))
                            {{App\Method::find($item->method_id)->title}}
                            @endif
                        </td>
                        <td>
                            @if(App\Method::find($item->method_id))
                            {{App\Method::find($item->lead)->title}}
                            @endif
                        </td>
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
                            @php
                            $moshavers = App\signalmoshaver::where("user_signal_id",$item->id)->get();
                            @endphp
                            @if($moshavers->count() > 0)
                            @foreach($moshavers as $signal)
                            @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->day;
                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                            @endphp
                            {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                            <br>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @if($signals->count() > 0)
                            @foreach($signals as $signal)
                            {{App\Doreha::find($signal->course_id)->title}}
                            <hr>
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @php
                            $moshavers = App\signalmoshaver::where("user_signal_id",$item->id)->get();
                            @endphp
                            @if($moshavers->count() > 0)
                            @foreach($moshavers as $moshaver)
                            @if($moshaver->vazeiat == "در حال بررسی")
                            <span class="bg-subtel-warning d-inline-block">
                                {{$moshaver->vazeiat}}
                            </span>
                            @endif
                            @if($moshaver->vazeiat == "ثبت نام کرد")
                            <span class="bg-subtel-success d-inline-block">
                                {{$moshaver->vazeiat}}
                            </span>
                            @endif
                            @if($moshaver->vazeiat == "قراره بیاید")
                            <span class="bg-subtel-primary d-inline-block">
                                {{$moshaver->vazeiat}}
                            </span>
                            @endif
                            @if($moshaver->vazeiat == "منصرف شده")
                            <span class="bg-subtel-orange d-inline-block ">
                                {{$moshaver->vazeiat}}
                            </span>
                            @endif
                            @endforeach
                            @endif
                        </td>
                        <td>
                            @switch($karbaran->karbar_role)
                            @case(0)
                            @break
                            @case(1)
                            @break
                            @case(2)
                            <a href="{{route("site.signal.moshaver",$item->id)}}" class="btn btn-dark">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('site.signal.create',"mobile=".$item->mobile)}}" class="btn btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>
                            @break
                            @endswitch
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
    </div>
</main>
@endsection
@section("scripts")
<script src="https://uni-everest.com/admin/assets/libs/datatables/datatables.js"></script>
<script>
    $("#zero_config").DataTable();
</script>
@endsection