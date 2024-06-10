<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'نام و نام خانوادگی') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('year', 'سابقه تدریس') !!}
            {!! Form::text('year', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', 'وضعیت') !!}
            @php
                $status = Collect(['active' => 'فعال', 'disable' => 'غیرفعال']);
            @endphp
            {!! Form::select('status', $status, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('image', 'تصویر') !!} <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ ($lecturer->image_url) ? $lecturer->image_url : 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">انتخاب تصویر</span>
                        <span class="fileinput-exists">تغییر</span>
                        {!! Form::file('image', ['required']) !!}
                    </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                </div>
            </div>
        </div>
    </div>
</div>