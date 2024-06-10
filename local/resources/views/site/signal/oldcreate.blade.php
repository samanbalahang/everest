<fieldset>
        <legend>
           ثبت کاربران سیگنال
        </legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="my-3">
                        <label for="fname" class="form-label">
                            نام
                        </label>
                        <input type="text" name="fname" id="fname">
                    </div>
                    <div class="my-3">
                        <label for="lname" class="form-label">
                            فامیل
                        </label>
                        <input type="text" name="lname" id="lname">
                    </div>
                </div>
                <div class="col-6">
                    <div class="my-3">
                        <label for="mobile" class="form-label">
                            موبایل
                        </label>
                        <input type="text" name="mobile" id="mobile">
                    </div>
                    <div class="my-3">
                        <label for="mellicode" class="form-label">
                            کد ملی
                        </label>
                        <input type="text" name="mellicode" id="mellicode">
                    </div>
                    <div class="my-3">
                        <label for="tozihat" class="form-label">
                            توضیحات
                        </label>
                        <textarea type="text" name="tozihat" id="tozihat">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="my-3">
            <div class="d-flex">
                <label for="birthDay" class="form-label">
                    سال تولد
                </label>
                <input type="text" name="birthDay" id="birthDay" min="4" max="4">
                <label for="birthDay" class="form-label">
                   سن
                </label>
                <input type="text" name="Age" id="Age" min="1" max="3">
            </div>
        </div>
        <div class="my-3">
            <label for="mellicode" class="form-label">
                   جنسیت
            </label>
            <select name="gender" id="gender" class="form-select">
                <option selected disabled>جنسیت</option>
                <option value="0">زن</option>
                <option value="1">مرد</option>
            </select>
        </div>
        <div class="my-3">
            <label for="field" class="form-label">
                رشته تحصیلی
            </label>
           <input type="text" name="field" id="field">
        </div>
        <div class="my-3">
            <label for="field" class="form-label">
                مقطع تحصیلی
            </label>
          <select name="field" id="field" class="form-select">
                <option selected disabled>
                    انتخاب مقطع تحصیلی
                </option>
                <option value="0">
                    دوره دبستان اول
                </option>
                <option value="1">
                    دوره دبستان دوم
                </option>
                <option value="2">
                    متوسطه اول
                </option>
                <option value="3">
                    متوسطه دوم
                </option>
                <option value="3">
                    متوسطه دوم
                </option>
                <option value="4">
                  دیپلم
                </option>
                <option value="5">
                  فوق دیپلم
                </option>
                <option value="6">
                  کارشناسی
                </option>
                <option value="7">
                  ارشد
                </option>
                <option value="7">
                  PhD
                </option>
          </select>
        </div>
        <div class="my-3">
            <label for="field" class="form-label">
                استان
            </label>
            <select name="state" onChange="CityList(this.value);">
                <option>لطفا استان را انتخاب نمایید</option>
                <option value="1">تهران</option>
                <option value="2">گیلان</option>
                <option value="3">آذربایجان شرقی</option>
                <option value="4">خوزستان</option>
                <option value="5">فارس</option>
                <option value="6">اصفهان</option>
                <option value="7">خراسان رضوی</option>
                <option value="8">قزوین</option>
                <option value="9">سمنان</option>
                <option value="10">قم</option>
                <option value="11">مرکزی</option>
                <option value="12">زنجان</option>
                <option value="13">مازندران</option>
                <option value="14">گلستان</option>
                <option value="15">اردبیل</option>
                <option value="16">آذربایجان غربی</option>
                <option value="17">همدان</option>
                <option value="18">کردستان</option>
                <option value="19">کرمانشاه</option>
                <option value="20">لرستان</option>
                <option value="21">بوشهر</option>
                <option value="22">کرمان</option>
                <option value="23">هرمزگان</option>
                <option value="24">چهارمحال و بختیاری</option>
                <option value="25">یزد</option>
                <option value="26">سیستان و بلوچستان</option>
                <option value="27">ایلام</option>
                <option value="28">کهگلویه و بویراحمد</option>
                <option value="29">خراسان شمالی</option>
                <option value="30">خراسان جنوبی</option>
                <option value="31" selected>البرز</option>
	        </select>
	<select name="city" id="city">
		<option value="0">لطفا استان را انتخاب نمایید</option>
	</select>
        </div>
        <div class="my-3">
            <label for="area">
                منطقه
            </label>
            <select name="area" id="area">
                <option selected>
                    لطفاً منطقه خود را انتخاب کنید!
                </option>
                @if($areas->count() > 0)
                    @foreach($areas as $area)
                    <option value="{{$area->id}}">{{$area->area}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="my-3">
            <label for="method">
                نحوه آشنایی
            </label>
            <select name="area" id="area">
                <option selected>
				نحوه آشنایی
                </option>
                @if($methods->count() > 0)
                    @foreach($methods as $method)
                    <option value="{{$method->id}}">{{$method->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="my-3">
            <label for="lead">
               سرنخ
            </label>
            <select name="lead" id="lead">
                <option selected>
				سرنخ
                </option>
                @if($methods->count() > 0)
                    @foreach($methods as $method)
						dd($method);
                    <option value="{{$method->id}}">{{$method->title}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
    </fieldset>
	<fieldset>
		<legend>
			ثبت سیگنال
		</legend>
		<div class="my-3">
            <label for="lead">
               دوره مد نظر کاربر
            </label>
            <select name="lead" id="lead">
                <option selected>
				دوره
                </option>
                @if($courses->count() > 0)
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
		<div class="my-3">
            <label for="request" class="form-label">
               درخواست ها
            </label>
            <textarea type="text" name="request" id="request">
        </div>
	</fieldset>