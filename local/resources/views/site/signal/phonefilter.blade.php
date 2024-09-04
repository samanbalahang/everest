@extends('site.layouts.main')
@section("seo")
<link rel="stylesheet" href="{{asset("assets/css/select2.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/css/sweetalert2.min.css")}}">
<style>
    body {
        direction: rtl !important;
    }

    main header {
        padding: 1rem 0;
    }

    main header ul {
        list-style: none;
        margin: 0;
        padding: 0;
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
        margin-right: .0625em;
        box-shadow: 0 0 0 0.0625em #b5bfd9;
        letter-spacing: .05em;
        color: #3e4963;
        text-align: center;
        transition: background-color .5s ease;
        border: 2px solid black
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
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
    @include("site.signal.header")
    <div class="container">
        <form action="{{route('site.signal.phone.filter.sabt')}}" method="post" id="form">
            @csrf
            <div class="row">
                <div class="my-3 col-12 col-md-3">
                    <label for="">
                        وضعیت
                    </label>
                    <select name="vazeiat" id="vazeiat" class="form-control">
                        <option value="" selected disabled>وضعیت کاربر را انتخاب کنید</option>
                        <option value="بدون نتیجه">بدون نتیجه</option>
                        <option value="قرار بیاید">قرار بیاید</option>
                        <option value="منصرف شد">منصرف شد</option>
                        <option value="در حال بررسی">در حال بررسی</option>
                        <option value="پاسخگو نبود">پاسخگو نبود</option>
                        <option value="ثبت نام کرد">ثبت نام کرد</option>
                        <option value="مشاوره نشده">مشاوره نشده</option>
                    </select>
                </div>
                <div class="my-3 col-12 col-md-3">
                    <label for="">
                        دوره
                    </label>
                    <select name="doreh" id="doreh" class="form-control">
                        <option value="" selected disabled>
                            دوره خود را انتخاب کنید.
                        </option>
                        @foreach ($doreha as $doreh)
                        <option value="{{$doreh->id}}">
                            {{$doreh->title}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3 col-12 col-md-3">
                    <label for="">
                        منطقه
                    </label>
                    <select name="area" id="area"  class="form-control">
                        <option selected disabled>
                            لطفاً منطقه مد نظر خود را انتخاب کنید
                        </option>
                        @foreach ($area as $makan)
                        <option value="{{$makan->id}}">
                            {{$makan->area}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3 col-12 col-md-3">
                    <label for="">
                        جنسیت
                    </label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="" selected>
                            همه زنان و مردان
                        </option>
                        <option value="0">
                            زن
                        </option>
                        <option value="1">
                            مرد
                        </option>
                    </select>

                </div>
            </div>
            <input type="submit" value="ثبت" class="btn btn-success">
        </form>
        <hr>
        @if(isset($users))
        <a href="" id="printes" download="filter.txt" target="_blank" class="btn btn-danger w-100 my-5">
            دریافت فایل شماره تلفن ها
        </a>
        @endif
        <table id="zero_config" class="table table-inverse table-striped table-bordered">
            <thead>
                <tr>
                    <th>
                        id
                    </th>
                    <th>
                        موبایل کاربر
                    </th>
                    <th>
                        نام و نام خانوادگی کاربر
                    </th>
                    <th>
                        دوره درخواستی کاربر
                    </th>
                    <th>
                        وضعیت ثبت نامی کاربر
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                $mobile = "";
                @endphp
                @if(isset($users))
                @foreach($users as $user)
                <tr>
                    @php
                    $mobile= $mobile.$user->mobile."\n";
                    @endphp
                    <td>{{$user->id}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->fname}}&nbsp;{{$user->lname}}</td>
                    <td>
                        @foreach ($doreha as $doreh)
                        @if($doreh->id == $user->course_id)
                        {{$doreh->title}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @if(isset($vazeiat))
                             {{$vazeiat}}   
                        @else
                            {{$user->vazeiat}}       
                        @endif
                    </td>
                </tr>

                @endforeach
                @endif
            </tbody>
        </table>
        @if(isset($users))
        <a href="" id="prints" download="filter.txt" target="_blank" class="btn btn-danger w-100 my-5">
            دریافت فایل شماره تلفن ها
        </a>
        @endif
    </div>
</main>
@endsection
@section("scripts")
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js')}}"></script>
<script src="https://uni-everest.com/admin/assets/libs/datatables/datatables.js"></script>
<script>
     $('select').select2();
    let mobile = " @if(isset($users)){{$users}}@endif";
    // console.log(mobile);
    if (mobile != "") {
        prints.href = 'data:text/plain;charset=utf-8,' + encodeURIComponent(`{{$mobile}}`);
        printes.href = 'data:text/plain;charset=utf-8,' + encodeURIComponent(`{{$mobile}}`);
    }
    var table = $("#zero_config").DataTable();
    $(".p-3.border").on("click", function() {
        var thisText = $(this).text().trim();
        table.search(thisText).draw();
    })
</script>

@endsection