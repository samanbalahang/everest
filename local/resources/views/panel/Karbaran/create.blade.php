@extends('panel.layouts.main')
@section('title')
افزودن کاربر
@endsection
@section('main')



<form action="{{Route("admin.karbaran.store")}}" method="post">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <label for="karbar_name" class="form-label">
                    نام کاربر:
                </label>
                <input type="text" name="karbar_name" id="karbar_name" class="form-control my-3" required>
                <label for="karbar_lname">
                    نام خانوادگی:
                </label>
                <input type="text" name="karbar_lname" id="karbar_lname" class="form-control  my-3" required>
                <label for="karbar_phone" class="form-label">
                    تلفن کاربر
                </label>
                <input type="text" name="karbar_phone" id="karbar_phone" class="form-control  my-3 text-left" onkeypress="allowNumbersOnly(event)" required>
                <label for="karbar_role">
                    نقش کاربری
                    <span class="text-danger" style="font-size: 0.8rem;">
                        (ثبت سیگنال فقط سیگنال ثبت میکند. مشاهده گر لیست را میبیند ولی امکان دیدن اطلاعات تماس را ندارد. مشاور امکان کلیک روی کلید مشاوره و تماس با سیگنال و ثبت نتیجه را دارد.)
                    </span>
                </label>
                <select id="karbar_role" name="karbar_role" class="select-controle" required>
                    <option value="0">
                        ثبت سیگنال
                    </option>
                    <option value="1">
                        مشاهدگر سیگنال
                    </option>
                    <option value="2">
                        مشاور
                    </option>
                </select>
                <label for="active" class="form-label my-3">
                    کاربر فعال
                    <span class="text-danger" style="font-size: 0.8rem;">
                        (کاربر غیر فعال هیج دسترسی به هیچ چیزی ندارد.)
                    </span>
                </label>
                <select name="active" id="active" class="select-control  my-3" required>
                    <option value="1">
                        فعال
                    </option>
                    <option value="0">
                        غیر فعال
                    </option>
                </select>

            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <label for="password" class="form-label my-3">
                            رمز عبور: 
                            <span class="text-danger">
                            رمز در بانک هش میشود و قابل بازیابی نیست لطفاً آن را در محلی ذخیره و یا به خاطر بسپارید.

                            </span>
                        </label>
                        <input type="text" name="password" id="password" class="form-control  my-3" required>
                    </div>
                    <div class="col-3 d-flex  align-items-end justify-content-center">
                        <a href="#" class="btn btn-success d-block my-3" id="createpass">
                            ایجاد پسورد
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <button type="submit" id="submit" class="btn btn-success d-block my-3 w-50">
    ثبت
    </button>
</form>
@endsection
@section("scripts")
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<script>
    console.log("mahgal");
    let karbar_phone = document.getElementById("karbar_phone");
    let createpass = document.getElementById("createpass");
    let password = document.getElementById("password")
    createpass.addEventListener("click", function(e) {
        e.preventDefault();
        let frand = randomnum();
        if (frand.toString().length < 6) {
            var length = frand.toString().length;
            var mis = 6 - parseInt(length);
            var one = "1";
            for (i = 1; i <= mis; i++) {
                one += "0";
            }
        }
        password.value = frand;
    });
    function randomnum() {
        var frand = Math.floor(Math.random() * 9999999);
        return frand;
    }
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
    // check Old User 
    $("#karbar_phone").on("blur", function() {
        $("#submit").prop("disabled", false);
        $("#karbar_phone").css("border","1px solid #dddddd;");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}",
            }
        });
        let data = {
            "mobile": $("#karbar_phone").val(),

        }
        $.ajax({
            url: "{{route('admin.karbal.old') }}",
            data: data,
            type: 'post',
            success: function(result) {
                if (result != "") {
                    Swal.fire("کاربر تکراری است").then(result=>{
                        $("#submit").prop("disabled",true);
                        $("#karbar_phone").focus();
                        $("#karbar_phone").val("");
                        $("#karbar_phone").css("border","1px solid red");
                    });
  
                }else{
                    $("#submit").prop("disabled",false);
                    $("#karbar_phone").css("border","1px solid #dddddd");
                }

            }
        });
    });
</script>
@endsection