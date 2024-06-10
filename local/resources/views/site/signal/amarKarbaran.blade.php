@extends('site.layouts.main')
@section("seo")
<link rel="stylesheet" href="https://uni-everest.com/admin/assets/libs/datatables/datatables.css">
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

    .bg-white {
        background-color: white !important;
    }

    .p-3.border {
        cursor: pointer;
    }

    .bg-secondary {
        background-color: #e7e8e9 !important;
    }

    .bg-success {
        background-color: #c0f3cb !important;
    }

    .bg-primary {
        background-color: #cadef3 !important;
    }

    .bg-danger {
        background-color: #f7b5bb !important;
    }

    .bg-warning {
        background-color: #fbebbc !important;
    }

    input {
        text-align: left;
        direction: ltr;
    }
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
    @include("site.signal.header")
    <main>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center border rounded w-100 p-3 my-3">
                <p>
                    تعداد کل سیگنال:
                    <span>
                        {{$kolSignal}}
                    </span>
                </p>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="my-3 col-4 ">
                        <label for="singledate">
                            در تاریخ:
                        </label>
                        <input type="text" name="singleDate" data-mask="0000/00/00" class="form-control" id="singleDate" />
                    </div>
                    <div class="my-3 col-4">
                        <label for="from">
                            از تاریخ:
                        </label>
                        <input type="text" name="fromDate" data-mask="0000/00/00" id="fromDate" class="form-control" />
                    </div>
                    <div class="my-3 col-4">
                        <label for="toDate">
                            تا تاریخ:
                        </label>
                        <input type="text" name="toDate" id="toDate" data-mask="0000/00/00" class="form-control" />
                    </div>
                    <a href="#" class="btn btn-success w-100 addfilter">
                        اعمال فیلتر
                    </a>
                </div>
            </div>
            <table id="zero_config" class="table table-inverse table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم کاربران</th>
                        <th>تعداد کاربر ثبت شده</th>
                        <th>تعداد سیگنال ثبت شده</th>
                        <th>تعداد مشاوره داده شده</th>
                        <th>درحال بررسی</th>
                        <th>قراره بیاید</th>
                        <th>بدون نتیجه</th>
                        <th>منصرف شده</th>
                        <th>ثبت نام کرده</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $j = 0;
                    $i = 1;
                    @endphp
                    @foreach ($allkarbaran as $item)
                    <tr>
                        <td>
                            {{$i++}}
                        </td>
                        <td>

                            {{$item->karbar_lname}}
                        </td>
                        <td>

                            {{$table[$j]["UserSignal"]}}
                        </td>
                        <td>

                            {{$table[$j]["signal"]}}
                        </td>
                        <td>

                            {{$table[$j]["moshavereh"]}}
                        </td>
                        <td>

                            {{$table[$j]["vazeiatDarha"]}}
                        </td>
                        <td>

                            {{$table[$j]["vazeiatGarar"]}}
                        </td>
                        <td>

                            {{$table[$j]["vazeiatBedon"]}}
                        </td>
                        <td>

                            {{$table[$j]["vazeiatMonsaref"]}}
                        </td>

                        <td>
                            {{$table[$j]["vazeiatSabt"]}}
                        </td>

                    </tr>
                    @php
                    $j++
                    @endphp
                    @endforeach
                </tbody>
            </table>


        </div>
    </main>
    @endsection
    @section("scripts")
    <script src="{{asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{asset("/assets/js/jquery.mask.min.js")}}"></script>
    <script src="https://uni-everest.com/admin/assets/libs/datatables/datatables.js">

    </script>
    <script>
        var table = $("#zero_config").DataTable();
        $(".addfilter").on("click", e => {
                    if ($("#singleDate").val() == "" && $("#fromDate").val() == "" && $("#toDate").val() == "") {
                        Swal.fire({
                            text: "داده ایی برای اعمال فیلتر وجود ندارد",
                            icon: "error",
                        }).then(() => {
                            $("#singleDate").focus();
                        });
                        $("#singleDate").focus();
                    } else if ($("#fromDate").val() != "" && $("#toDate").val() == "") {
                        Swal.fire({
                            text: "فیلد تا تاریخ را پر کنید",
                            icon: "error",
                        }).then(() => {
                            $("#toDate").focus();
                        });
                        $("#toDate").focus();
                    }else if($("#fromDate").val() != "" && $("#toDate").val() != "" && $("#singleDate").val() != ""){
                        $("#singleDate").val() = "";
                    }else if($("#fromDate").val() != "" && $("#toDate").val() != "" && $("#singleDate").val() == ""){
                        let fromDate = $("#fromDate").val();
                        let toDate   = $("#toDate").val();
                        let fromTimestamp =  jalaliToUTCTimeStamp(parseInt(removeZiro(fromDate.split("/")[0])), parseInt(removeZiro(fromDate.split("/")[1])), parseInt(removeZiro(fromDate.split("/")[2])));
                        fromTimestamp     = parseInt(String(fromTimestamp).substring(0,10));
                        let toDateTimestamp = jalaliToUTCTimeStamp(parseInt(removeZiro(toDate.split("/")[0])), parseInt(removeZiro(toDate.split("/")[1])), parseInt(removeZiro(toDate.split("/")[2])));
                        toDateTimestamp     = parseInt(String(toDateTimestamp).substring(0,10));
                        data = {
                            "fromDate": fromTimestamp,
                            "toDate"  : toDateTimestamp,
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{csrf_token()}}',
                            }
                        });
                        $.ajax({
                            url: "{{route('site.signal.ajax.single.date.fromto')}}",
                            data: data,
                            type: 'POST',
                            success: function(response) {
                                response = JSON.parse(response);
                                let thearray = response[7];
                                console.log(thearray);
                                console.log(thearray[0]['lname']);
                                let finalarray = [];
                                let i = 0;
                                let j = 0;
                                let trs = $("#zero_config tr");
                                console.log(trs);
                                for (let index = 1; index < trs.length; index++) {
                                    const element = trs[index];
                                    i++;
                                    $(element).find("td:first-child").text(i);
                                    $(element).find("td:nth-child(2)").text(thearray[j]['lname']);
                                    $(element).find("td:nth-child(3)").text(thearray[j]['UserSignal']);
                                    $(element).find("td:nth-child(4)").text(thearray[j]['signal']);
                                    $(element).find("td:nth-child(5)").text(thearray[j]['moshavereh']);
                                    $(element).find("td:nth-child(6)").text(thearray[j]['vazeiatDarha']);
                                    $(element).find("td:nth-child(7)").text(thearray[j]['vazeiatGarar']);
                                    $(element).find("td:nth-child(8)").text(thearray[j]['vazeiatBedon']);
                                    $(element).find("td:nth-child(9)").text(thearray[j]['vazeiatMonsaref']);
                                    $(element).find("td:nth-child(10)").text(thearray[j]['vazeiatSabt']);
                                    j++;
                                }
                                Swal.fire({
                                text: `داده ها از تاریخ 
                                ${fromDate}
                                تا تاریخ
                                 ${toDate}
                                 فیلتر شده است`,
                                icon: "success",
                                });
                            }      
                        });
                    }else if ($("#singleDate").val() != "") {
                        let singleDate = $("#singleDate").val();
                        let srigdatde  = jalaliToUTCTimeStamp(parseInt(removeZiro(singleDate.split("/")[0])), parseInt(removeZiro(singleDate.split("/")[1])), parseInt(removeZiro(singleDate.split("/")[2])));
                        srigdatde     = parseInt(String(srigdatde).substring(0,10));
                        // console.log(srigdatde);
                        // console.log(new Date(srigdatde));
                        data = {
                            "singleDate": srigdatde,
                        }
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{csrf_token()}}',
                            }
                        });
                        $.ajax({
                            url: "{{route('site.signal.ajax.single.date')}}",
                            data: data,
                            type: 'POST',
                            success: function(response) {
                                response = JSON.parse(response);
                                let thearray = response[7];
                                console.log(thearray);
                                console.log(thearray[0]['lname']);
                                let finalarray = [];
                                let i = 0;
                                let j = 0;

                                let trs = $("#zero_config tr");
                                console.log(trs);
                                for (let index = 1; index < trs.length; index++) {
                                    const element = trs[index];
                                    i++;
                            
                                    // console.log($(element));
                                    // console.log($(element).find("td"));
                                    // console.log($(element).find("td"));
                                    // console.log($(element).find("td[0]"));
                                    // console.log($(element).find("td:first-child"));
                                    // console.log("i: "+ i);
                                    // console.log("j: "+ j);
                                    // console.log($(element).find("td:first-child").text());
                                    // console.log($(element).find("td:nth-child(2)").text());
                                    $(element).find("td:first-child").text(i);
                                    $(element).find("td:nth-child(2)").text(thearray[j]['lname']);
                                    $(element).find("td:nth-child(3)").text(thearray[j]['UserSignal']);
                                    $(element).find("td:nth-child(4)").text(thearray[j]['signal']);
                                    $(element).find("td:nth-child(5)").text(thearray[j]['moshavereh']);
                                    $(element).find("td:nth-child(6)").text(thearray[j]['vazeiatDarha']);
                                    $(element).find("td:nth-child(7)").text(thearray[j]['vazeiatGarar']);
                                    $(element).find("td:nth-child(8)").text(thearray[j]['vazeiatBedon']);
                                    $(element).find("td:nth-child(9)").text(thearray[j]['vazeiatMonsaref']);
                                    $(element).find("td:nth-child(10)").text(thearray[j]['vazeiatSabt']);
                                    j++;
                                    // console.log($(element).find("td:first-child"));
                                };
                                Swal.fire({
                                    text: `داده های تاریخ
                                    ${singleDate}
                                    را مشاهده میکنید`,
                                    icon: "success",
                                });
                            }
                            
                             
                               
                        });
                        }
                        e.preventDefault();
                    });
                // $(".p-3.border").on("click", function() {
                //     var thisText = $(this).text().trim();
                //     console.log(thisText);
                //     table.search(thisText).draw();
                // })
                function removeZiro(text) {
                    text = String(text);
                    if (text.indexOf("0") == 0) {
                        return text.slice(1);
                    } else {
                        return text;
                    }
                }

                function jalaliToUTCTimeStamp(year, month, day) {
                    // console.log(year);
                    // console.log(month);
                    // console.log(day);
                    const format = new Intl.DateTimeFormat('en-u-ca-persian', {
                        dateStyle: 'short',
                        timeZone: "UTC"
                    });
                    let g = new Date(Date.UTC(2000, month, day));
                    g = new Date(g.setUTCDate(g.getUTCDate() + 226867));
                    const gY = g.getUTCFullYear(g) - 2000 + year;
                    g = new Date(((gY < 0) ? "-" : "+") + ("00000" + Math.abs(gY)).slice(-6) + "-" + ("0" + (g.getUTCMonth(g) + 1)).slice(-2) + "-" + ("0" + (g.getUTCDate(g))).slice(-2));
                    let [pM, pD, pY] = [...format.format(g).split("/")], i = 0;
                    g = new Date(g.setUTCDate(g.getUTCDate() + ~~(year * 365.25 + month * 30.44 + day - (pY.split(" ")[0] * 365.25 + pM * 30.44 + pD * 1)) - 2));
                    while (i < 4) {
                        [pM, pD, pY] = [...format.format(g).split("/")];
                        if (pD == day && pM == month && pY.split(" ")[0] == year) return +g;
                        g = new Date(g.setUTCDate(g.getUTCDate() + 1));
                        i++;
                    }
                    throw new Error('Invalid Persian Date!');
                }
    </script>

    @endsection