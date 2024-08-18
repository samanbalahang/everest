@extends('site.layouts.main')
@section("seo")
<link rel="stylesheet" href="{{asset("assets/css/select2.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/css/sweetalert2.min.css")}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="{{asset("assets/css/FarsiCalender.css")}}">
<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 100,
            'GRAD' 0,
            'opsz' 24
    }

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
    <div class="container-fluid">
        <div class="user d-flex justify-content-between align-items-center">
            <form action="#">
                @csrf
                <div class="my-3">
                    <label for="">
                        موبایل
                    </label>
                    <input type="text" name="mobile" id="mobile" class="form-control" required value="@if(isset($_GET[" mobile"])){{$_GET["mobile"]}} @endif" @if(isset($_GET["mobile"])) {{'autofocus'}} @endif onkeypress="allowNumbersOnly(event)" min="100000000">
                </div>
            </form>
            <p id="gender">

            </p>
            <p id="fname">

            </p>
            <p id="lname">

            </p>
            <p id="request">

            </p>
        </div>
        <div class="calendar-wrapper">
            <div class="calendar-base">

                <div class="year-wrapper">
                </div>
                <div class="arrows">
                    <a href="#" id="leftArrow">
                        <span class="material-symbols-outlined">
                            chevron_left
                        </span>
                    </a>
                    <a href="#">
                        <span id="ActiveMonth"></span>
                    </a>
                    <a href="#" id=rightArrow>
                        <span span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </a>
                </div>
                <div class="months">
                    <span class="month-hover month-letter month-letter-1" data-num="1">فروردین</span>
                    <span class="month-hover month-letter month-letter-2" data-num="2">اردیبهشت</span>
                    <span class="month-hover month-letter month-letter-3" data-num="3">خرداد</span>
                    <span class="month-hover month-letter month-letter-4" data-num="4">تیر</span>
                    <span class="month-hover month-letter month-letter-5" data-num="5">مرداد</span>
                    <span class="month-hover month-letter month-letter-6" data-num="6">شهریور</span>
                    <span class="month-hover month-letter month-letter-7" data-num="7">مهر</span>
                    <span class="month-hover month-letter month-letter-8" data-num="8">آبان</span>
                    <span class="month-hover month-letter month-letter-9" data-num="9">آذر</span>
                    <span class="month-hover month-letter month-letter-10" data-num="10">دی</span>
                    <span class="month-hover month-letter month-letter-11" data-num="11">بهمن</span>
                    <span class="month-hover month-letter month-letter-12" data-num="12">اسفند</span>
                </div>
                <hr class="month-line" />

                <div class="days">
                    <ul class="weeks">
                        <li>شنبه</li>
                        <li>یکشنبه</li>
                        <li>دوشنبه</li>
                        <li>سه شنبه</li>
                        <li>چهارشنبه</li>
                        <li>پنجشنبه</li>
                        <li>جمعه</li>
                        <div class="clearfix"></div>
                    </ul>
                </div>

                <div class="num-dates"></div>

            </div>

            <div class="calendar-left active-season" style="display: none;">
                <div class="num-date">X</div>
                <div class="day">X</div>
            </div>
        </div>
        <div class="clearfix"></div>


    </div>
</main>
@endsection
@section("scripts")
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/js/Farsicalender/calendarObject.js')}}"></script>
<script src="{{ asset('assets/js/Farsicalender/app.js')}}"></script>
<script src="{{ asset('assets/js/Farsicalender/mine.js')}}"></script>
<script>
    window.addEventListener("load", () => {
      
        let shagerd_id;
        // فقط عدد میگیرد
        function allowNumbersOnly(e) {
            var code = (e.which) ? e.which : e.keyCode;
            // if (code > 31 && (code < 48 || code > 57)) {
            // 	e.preventDefault();
            // }
            if (e.target.value.length > 10 || (code > 31 && (code < 48 || code > 57))) {
                e.preventDefault();
            }
        }

        // با خروج کاربر از فیلد موبایل دنبال کاربری با آن شماره میگردیم	
        $("#mobile").on("blur", function() {
            if ($(this).val().length < 11) {
                Swal.fire({
                    text: "شماره موبایل غلط است",
                }).then(() => {
                    $(this).focus();
                    $(this).val("");
                });
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    }
                });
                let data = {
                    "mobile": $("#mobile").val(),
                }
                $.ajax({
                    url: "{{route('site.signal.olduser') }}",
                    data: data,
                    type: 'post',
                    success: function(result) {
                        if (result != "") {
                            let gender;
                            if (result.gender == 1) {
                                gender = 'آقای';
                            } else {
                                gender = 'خانم';
                            }
                            shagerd_id = result.id;
                            $("#fname").text(result.fname);
                            $("#lname").text(result.lname);
                            $("#gender").text(gender);
                            $("#request").text(result.request);
                            Swal.fire({
                                text: `میتوانید به کاربر نوبت مشاوره دهید`,
                                icon: 'success',
                            });
                        }
                    }
                });
            }
        });


        // کلیک روی هر روز 
        let dayElement = document.querySelectorAll(".day-element");
        let QurentDayElemant = document.querySelector(".day-element.active-season");
        let thisMonth = parseInt(QurentDayElemant.classList[1].substring(5, 6));
        let thisDay = parseInt(QurentDayElemant.classList[1].substring(7));
        var nobat = "";
        dayElement.forEach((day) => {
            day.addEventListener("click", () => {              
                if($("#mobile").val() != ""){
                let clickedDayMonth = parseInt(day.classList[1].substring(5, 6));
                let clickedDayDay = parseInt(day.classList[1].substring(7));
                if (clickedDayMonth >= thisMonth && clickedDayDay >= thisDay) {
                    var users = day.dataset.user.split(',');
                    var userslenght = users.length;

                    users.forEach(item => {
                        nobat += `<p>
                        ${item}
                        </p>
                        `;
                    });
                    Swal.fire({
                        title: "<strong>تعیین نوبت <u>برای کاربر</u></strong>",
                        width: '100%',
                        icon: "info",
                        html: `
                            ${nobat}
                            <input type="time" name="time" id="thetime">
                             `,
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText: `
                            رزور کن!
                           `,
                        confirmButtonAriaLabel: "Thumbs up, great!",
                        cancelButtonText: `
                            <i class="fa fa-thumbs-down"></i>
                        `,
                        cancelButtonAriaLabel: "Thumbs down"
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                                }
                            });
                            let data = {
                                "class": QurentDayElemant.classList[1],
                                "year": '1403',
                                "month": String(thisMonth),
                                "day": String(thisDay),
                                "hour": thetime.value,
                                "usersignal_id": shagerd_id,
                            }
                            $.ajax({
                                url: "{{route('site.signal.nobat.sabt') }}",
                                data: data,
                                type: 'post',
                                success: function(result) {
                                    if (result == "done") {
                                        day.classList.add(`usersignal_id-${shagerd_id}`);
                                        Swal.fire({
                                            title: "ثبت شد",
                                            text: "رزور ثبت شد",
                                            icon: "success"
                                        });
                                        let karbaran = day.querySelector(".karbaran");
                                        if (karbaran == null) {
                                            let span = document.createElement("small");
                                            span.classList.add("karbaran");
                                            span.innerText = 1;
                                            day.prepend(span);
                                        } else {
                                            karbaran.innerText = parseInt(karbaran.innerText) + 1;
                                        }
                                    }
                                }
                            });
                        }
                    });
                } else {
                    let karbaran = day.querySelector(".karbaran");
                    var users = day.dataset.user.split(',');
                    var userslenght = users.length;
                    nobat = "";
                    users.forEach(item => {
                        nobat += `<p>
                        ${item}
                        </p>
                        `;
                    });
                    if (karbaran != null) {
                        Swal.fire({
                        title: "<strong>مشاهده نوبت<u>کاربران</u></strong>",
                        width: '100%',
                        icon: "info",
                        html: `
                            ${nobat}
                             `,
                        showCloseButton: true,
                        focusConfirm: false,
                        confirmButtonText: `
                            مشاهده شد!
                           `,
                    })
                    } else {
                        Swal.fire({
                            title: "خطا",
                            text: "امکان رزور در تاریخ های قبلی وجود ندارد",
                            icon: "error"
                        });
                    }
                }
                }else{
                    // اگر موبایل پر نشده
                    $("#mobile").focus();
                    Swal.fire({
                            title: "خطا",
                            text: "شماره موبایل الزامی است.",
                            icon: "error"
                        });
                  
                }
            });
        });

        // دریافت کلیه نوبت های مشاوره در بانک داده
        let allMoshavereh = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                }
            });
            $.ajax({
                url: "{{route('site.signal.nobat.all')}}",
                type: 'post',
                success: function(result) {
                    result = JSON.parse(result);
                    result.forEach(items => {
                        var classes = items[0].class;
                        var day = document.querySelector(`.${classes}`);
                        let karbaran = day.querySelector(".karbaran");
                        if (karbaran == null) {
                            let span = document.createElement("small");
                            span.classList.add("karbaran");
                            span.innerText = 1;
                            day.prepend(span);
                            day.setAttribute("data-user", `${items[1].mobile}-${items[1].fname}-${items[1].lname}-${items[0].hour}`);
                        } else {
                            karbaran.innerText = parseInt(karbaran.innerText) + 1;
                            day.dataset.user = day.dataset.user + `,${items[1].mobile}-${items[1].fname}-${items[1].lname}-${items[0].hour}`;
                        }
                      });
                }
            });
        }
        // دریافت مشاوره های قبلی
        allMoshavereh();
    });
</script>
@endsection