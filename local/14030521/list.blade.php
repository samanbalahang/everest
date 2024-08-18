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
    .bg-white{
        background-color: white !important;
    }
    .p-3.border{
        cursor: pointer;
    }
    .bg-secondary{
        background-color: #e7e8e9 !important;
    }
    .bg-success{
        background-color: #c0f3cb !important;
    }
    .bg-primary{
        background-color: #cadef3 !important;
    }   
    .bg-danger{
        background-color: #f7b5bb !important;
    }
    .bg-warning{
        background-color: #fbebbc !important;
    }
    .bg-purple{
        background-color: #8000806e !important;
    }
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
@include("site.signal.header")
    <div class="container-fluid">
        <h2 class="text-center">
            لیست سیگنالها
        </h2>
        <div class="col-4 mr-auto d-flex flex-wrap border d-inline-block ">
             <p class="px-3 py-3 border">
                <a href="{{route("site.signal.list")}}">
                تمام داده ها 
                </a>
            </p>    
            <p class="p-3 border">
               مشاوره نشده
                <span class="p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-warning">
                در حال بررسی
                <span class="bg-warning p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-danger">
                منصرف شد
                <span class="bg-danger p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-primary">
                قرار بیاید
                <span class="bg-primary p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-purple">
                پاسخگو نبود
                <span class="bg-purple p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-success">
               ثبت نام کرد
                <span class="bg-success p-1 border d-inline-block"></span>
            </p>
            <p class="p-3 border bg-secondary">
                بدون نتیجه
                <span class="bg-secondary p-1 border d-inline-block"></span>
            </p>
        </div>
        <div class="p-3 d-inline-bloc">
            <table id="zero_config" class="table table-inverse table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام
                            نام خانوادگی</th>
                        <th>
                         ثبت کننده
                        </th>    
                        <th>
                         مشاوره دهنده
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
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    $bg = "";
                    @endphp
                    @if($users->count() >0)

                    @foreach ($users as $item)
                        @php
                            $moshavers = App\signalmoshaver::where("user_signal_id",$item->usersignalId)->where("signal_id",$item->signalid)->first();

                        @endphp

                        @if($moshavers != null)
                            @switch($moshavers->vazeiat)
                                @case(null)
                                    @php 
                                        $bg = 'class=bg-white' 
                                    @endphp
                                    @break
                                @case("بدون نتیجه")
                                    @php 
                                        $bg = 'class=bg-secondary' 
                                    @endphp
                                    @break
                                @case("قرار بیاید")
                                    @php 
                                        $bg = 'class=bg-primary' 
                                    @endphp
                                    @break
                                @case("منصرف شد")
                                    @php 
                                        $bg = 'class=bg-danger' 
                                    @endphp
                                    @break
                                @case("در حال بررسی")
                                    @php 
                                        $bg = 'class=bg-warning' 
                                    @endphp
                                    @break
                                @case("پاسخگو نبود")
                                    @php 
                                        $bg = 'class=bg-purple' 
                                    @endphp
                                    @break
                                @case("ثبت نام کرد")
                                    @php 
                                        $bg = 'class=bg-success' 
                                    @endphp
                                    @break
                            @endswitch 
                        @else
                            @php 
                                $bg = 'class=bg-white' 
                            @endphp
                        @endif       
                    <tr {{$bg}}>
                        <td>{{ $i }}</td>
                        <td>
                       {{ $item->fname }} {{ $item->lname }}    
                        </td>
                        <td>
                            @if(App\Kaebaran::find($item->usersignalKarbar))
                            {{App\Kaebaran::find($item->usersignalKarbar)->karbar_lname}}
                            @endif
                        </td>
                        <td>
                            @if(App\Kaebaran::find($item->moshaverKarbar))
                            {{App\Kaebaran::find($item->moshaverKarbar)->karbar_lname}}
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
                            
                            @case(0)
                            {{__("زن")}}
                            @break
                            @case(1)
                            {{__("مرد")}}
                            @break
                            @case(null)
                            {{__("")}}
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
                            @if(App\Sarnakh::find($item->lead))
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
                            @if($item->signalmoshaverupdated_at)
                            @php
                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->signalmoshaverupdated_at)->year;
                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->signalmoshaverupdated_at)->month;
                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->signalmoshaverupdated_at)->day;
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
                            @if($moshavers)
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
                            @switch($karbaran->karbar_role)
                                @case(0)
                                @break
                                @case(1)
                                @break
                                @case(2)
                                <a href="{{route("site.signal.moshaver",$item->usersignalId)}}" class="btn btn-dark">
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
    var table = $("#zero_config").DataTable();
    
    $(".p-3.border").on("click",function(){
       var thisText = $(this).text().trim();
       console.log(thisText);
       table.search(thisText).draw();
    })
</script>
@endsection