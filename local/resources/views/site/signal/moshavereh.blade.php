@extends('site.layouts.main')
@section("seo")
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

    aside::-webkit-scrollbar {
        width: 10px;
    }

    aside::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    aside::-webkit-scrollbar-thumb {
        background: #888;
    }

    aside::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    aside {
        background-color: #e7f2ff;
        color: black;
        box-shadow: -3px 5px 2px 0px #00000057;
        margin: 0;
        padding: 0 !important;
        height: 100vh;
        overflow-y: scroll;
    }

    aside h2 {
        padding: 1rem;
        font-size: 1rem;
    }

    main aside>nav>ul {
        display: block;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    aside ul li {
        border-bottom: 1px solid black;
        cursor: pointer;
        padding: 1rem;
    }

    aside>nav>ul>li:nth-child(odd) {
        background-color: #ededed;
    }

    aside>nav>ul>li:nth-child(odd).active {
        background-color: #b4b4ff;
    }

    aside>nav>ul>li:nth-child(even) {
        background-color: #d0cece;
    }

    aside>nav>ul>li:nth-child(even).active {
        background-color: blueviolet;
    }

    .top-0 {
        top: 3rem;
    }

    #messages {
        background: white;
        left: 50%;
        right: 50%;
        z-index: 5;
        padding: 3rem;
        border: 1px solid black;
        transform: translate(43%, 10px);
        box-shadow: -2px 3px 20px #00000066;
    }

    .mainMenu,
    .mainHeader {
        display: none;
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
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="border rounded p-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 border">
                            <p class="text-center">
                                نام : 
                                <br>
                                {{$user->fname}}
                            </p>
                        </div>
                        <div class="col-4 border">
                            <p class="text-center">
                                نام خانوادگی : 
                                <br>
                                {{$user->lname}}
                            </p>
                        </div>
                        <div class="col-4 border">
                            <p class="text-center">
                                جنسیت : 
                                <br>
                                @switch($user->gender)
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
                            </p>
                        </div>
                        <div class="col-4 border" >
                            <p class="text-center">
                                کد ملی : 
                                <br>
                                {{$user->mellicode}}
                            </p>
                        </div>
                        <div class="col-4 border">
                            <p class="text-center">
                                موبایل : 
                                <br>
                                {{$user->mobile}}
                            </p>
                        </div>
                        <div class="col-4 border">
                            <p class="text-center">
                                سن : 
                                <br>
                                {{$user->Age}}
                            </p>
                        </div>
                        <div class="col-12 border">
                            <p class="text-right">
                                توضیحات : 
                                <br>
                                {{$user->tozihat}}
                            </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="border rounded p-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-right">
                                    نحوه آشنایی: &nbsp;
                                    <span>
                                    @if(App\Ashnaee::find($user->method_id))
                                        {{App\Ashnaee::find($user->method_id)->title}}
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-right">
                                    سرنخ:  &nbsp;
                                    <span>
                                        @if(App\Sarnakh::find($user->lead))
                                            {{App\Sarnakh::find($user->lead)->title}}
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-right">
                                درخواست:  &nbsp;
                                    <span>
                                    {{$user->request}}
                                    </span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-right">
                                    تاریخ ثبت درخواست: &nbsp;
                                    @php
                                    $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->year;
                                    $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->month;
                                    $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->day;
                                    $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                    @endphp
                                    {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-right">
                                    کاربر ثبت کننده: &nbsp;
                                    {{App\Kaebaran::find($user->karbar_id)->karbar_lname}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('site.signal.create',"mobile=".$user->mobile)}}" class="btn btn-warning d-block mr-auto w-25">
        <i class="fa fa-edit"></i>
        ویرایش اطلاعات کاربر
        </a>
    </div>
    <div class="container">
        <div class="p-3">

            <main>
                <div class="container-flouid">
                    <div class="row">
                        <aside class="col-3">
                            <h2 class="text-center">
                                سیگنال ها
                            </h2>
                            <nav>
                                <ul>
                                    @foreach($signals as $signal)
                                    <li data-id="{{$signal->id}}">
                                        @if(App\Doreha::find($signal->course_id))
                                        نام دوره: 
                                        {{App\Doreha::find($signal->course_id)->title}}
                                        @endif
                                        <br>
                                        تاریخ درخواست:
                                        @php
                                            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->year;
                                            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->month;
                                            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->created_at)->day;
                                            $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                            @endphp
                                            {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                        <br>
                                        درخواست: 
                                        {{$signal->request}}
                                        @php
                                        $signalmoshaver = App\signalmoshaver::where("signal_id",$signal->id)->where("user_signal_id",$user->id)->first();
                                        @endphp
                                        @if($signalmoshaver != null)
                                        <br>
                                        وضعیت ها:
                                        <br>
                                        @php
                                        $moshavereh = App\signalmoshaver::where("signal_id",$signal->id)->where("user_signal_id",$user->id)->get();
                                        @endphp
                                        @if($moshavereh->count() > 0)
                                        @foreach($moshavereh as $signal)
                                        <button class="btn btn-secondary w-100" onclick="oldsignal({{$signal->id}})">
                                        @php
                                        $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->updated_at)->year;
                                        $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->updated_at)->month;
                                        $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $signal->updated_at)->day;
                                        $date = \Morilog\Jalali\jDateTime::toJalali($year, $month, $day);
                                        @endphp
                                            {{ $date[0] }}/{{ $date[1] }}/{{ $date[2] }}
                                            {{$signal->vazeiat}}
                                        </button>
                                        <br>
                                        @endforeach
                                        @endif
                                        @endif
                                        <button class="btn btn-success my-3 w-100">
                                           ثبت سیگنال جدید
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </aside>
                        <div class="col-9">
                            <div class="p-3">
                                <form action="{{route("site.signal.moshaver.sabt")}}" method="post">
                                    @csrf
                                    <input type="hidden" name="karbar_id" id="karbar_id" value="{{$karbaran->id}}">
                                    <input type="hidden" name="user_signal_id" id="user_signal_id" value="{{$user->id}}">
                                    <input type="hidden" value="" id="signal_id" name="signal_id" class="form-control">
                                    <div class="mt-3">
                                        <label for="maharat">
                                            مهارت فعلی
                                        </label>
                                        <input type="text" name="maharat" id="maharat" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="hadaf">
                                            هدف
                                        </label>
                                        <input type="text" name="hadaf" id="hadaf" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="naiz">
                                            نیازمندیهای اطلاع داده شده
                                        </label>
                                        <input type="text" name="naiz" id="naiz" class="form-control">
                                    </div>
                                    <div class="mt-3">
                                        <label for="vazeiat">
                                            وضعیت
                                        </label>
                                        <select name="vazeiat" id="vazeiat" class="form-control">
                                            <option value="بدون نتیجه">بدون نتیجه</option>
                                            <option value="قرار بیاید">قرار بیاید</option>
                                            <option value="منصرف شد">منصرف شد</option>
                                            <option value="در حال بررسی">در حال بررسی</option>
                                            <option value="ثبت نام کرد">ثبت نام کرد</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="tozih">
                                            توضیحات
                                        </label>
                                        <textarea name="tozih" id="tozih" class="form-control"></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success w-100 my-3" value="ثبت مشاوره">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</main>
@endsection
@section("scripts")
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script>
    function oldsignal(id){
        console.log(id);
        data = {
            "id" : id,
        }
        Swal.fire({
            text: "شما داده های  سیگنال قبلی را مشاهده میکنید",
        });
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}',
			}
		});
		$.ajax({
			url: "{{route('site.signal.ajax.moshaver')}}",
			data: data,
			type: 'POST',
			success: function(response) {
				console.log(response);
				console.log(JSON.parse(response));
				response = JSON.parse(response);
 				$("#thearea").html("");
				if (response.id  != undefined) {
                        $("#maharat").val(response.maharat);
                        $("#hadaf").val(response.hadaf);
                        $("#naiz").val(response.naiz);
                        $("#vazeiat").val(response.vazeiat);
                        $("#tozih").text(response.tozih);
						console.log(response.maharat);
						console.log(response.naiz);
						console.log(response.tozih);
					} else {
						
					}
			}
		});

    }
   

    $("form *").on("focus", function() {
        if (!$("aside li").hasClass("active")) {
            $("body").append(`
                <div class="position-fixed top-0 w-50 " id="messages">
                    <p>
                    ابتدا از پنل سمت راست روی یک سیگنال کلیک کنید.!
                    </p>
                    <a href="#" class="btn btn-success w-100 my-3" id="clossMessage">
                        باشه
                    </a>
                </div>`);
            $("#clossMessage").on("click", (e) => {
                $("#messages").remove();
                $("form *").focusout();
                console.log("a");
                e.preventDefault();
            })
        }
    });
    $("aside li").on("click", function() {
        $("aside li").removeClass("active");
        $(this).toggleClass("active");
        $("#signal_id").val($(this).data("id"));
    })
</script>
@endsection