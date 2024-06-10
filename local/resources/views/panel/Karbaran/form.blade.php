<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'تیتر') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('job_cat_id', 'دسته بندی') !!}
            {!! Form::select('job_cat_id', App\JobCat::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('desc', 'خلاصه') !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control', 'required', 'style' => 'height: 100px']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('content', 'توضیحات') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('end_date', 'تاریخ پایان') !!}
            {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => '2018-12-30', 'required']) !!}
        </div>
    </div> --}}
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('department_id', 'دپارتمان') !!}
            {!! Form::select('department_id', App\Department::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
                $featured = Collect(['no' => 'خیر', 'yes' => 'بله']);
            @endphp
            {!! Form::label('featured', 'ویژه') !!}
            {!! Form::select('featured', $featured, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(function(){
      $('#content').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize', 'fontname', 'style']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'table', 'hr']],
            ['misc', ['fullscreen', 'code', 'under', 'redo', 'codeview']]
        ],
        tabsize: 2,
        height: 300
      });
    });
</script>
@endsection