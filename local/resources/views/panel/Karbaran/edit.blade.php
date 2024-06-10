@extends('panel.layouts.main')
@section('title')
ویرایش کاربر
@endsection
@section('main')
<form action="{{Route("admin.karbaran.update",$karbaran->id)}}" method="post">
    @method("put")
    @csrf
    <label for="karbar_name" class="form-label">
        نام کاربر:
    </label>
    <input type="text" name="karbar_name" id="karbar_name" class="form-control my-3" value="{{$karbaran->karbar_name}}">
    <label for="karbar_lname">
        نام خانوادگی:
    </label>
    <input type="text" name="karbar_lname" id="karbar_lname" class="form-control  my-3" value="{{$karbaran->karbar_lname}}">
    <label for="karbar_phone" class="form-label">
        تلفن کاربر
    </label>
    <input type="text" name="karbar_phone" id="karbar_phone" class="form-control  my-3 text-left"  onkeypress="allowNumbersOnly(event)" value="{{$karbaran->karbar_phone}}">
    <label for="karbar_role">
        نقش کاربری
        <span class="text-danger" style="font-size: 0.8rem;">
            (ثبت سیگنال فقط سیگنال ثبت میکند. مشاهده گر لیست را میبیند ولی امکان دیدن اطلاعات تماس را ندارد. مشاور امکان کلیک روی کلید مشاوره و تماس با سیگنال و ثبت نتیجه را دارد.)
        </span>
    </label>
    <select id="karbar_role" name="karbar_role" class="select-controle"  value="{{$karbaran->karbar_role}}">
        <option value="0" @if($karbaran->karbar_role == 0) {{__('selected')}} @endif >
            ثبت سیگنال
        </option>
        <option value="1" @if($karbaran->karbar_role == 1) {{__('selected')}} @endif >
            مشاهدگر سیگنال
        </option>
        <option value="2" @if($karbaran->karbar_role == 2) {{__('selected')}} @endif >
            مشاور
        </option>
    </select>
    <label for="active" class="form-label my-3">
        کاربر فعال 
        <span class="text-danger" style="font-size: 0.8rem;">
            (کاربر غیر فعال هیج دسترسی به هیچ چیزی ندارد.)
        </span>
    </label>
    <select name="active" id="active" class="select-control  my-3" value="{{$karbaran->active}}">
        <option value="1">
                فعال
        </option>
        <option value="0">
                غیر فعال
        </option>
    </select>
    <label for="password" class="form-label my-3">
        رمز عبور جدید
    </label>
    <input type="text" name="password" id="password" class="form-control  my-3"  value="">
    <a href="#" class="btn btn-success d-block my-3 w-25 ml-auto" id="createpass" >
        ایجاد پسورد
    </a>
    <input type="submit" class="btn btn-success d-block my-3 w-100" value="ثبت">
</form>
@endsection
@section("scripts")
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
</script>
@endsection