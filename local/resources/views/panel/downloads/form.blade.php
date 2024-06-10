<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'تیتر') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('download_cat_id', 'دسته بندی') !!}
            {!! Form::select('download_cat_id', App\DownloadCat::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('desc', 'خلاصه') !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control', 'required', 'style' => 'height: 100px;']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('content', 'توضیحات') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('file', 'فایل') !!}
            <br>
            @if ($download->file_url)
            <a href="{{ $download->file_url }}" target="_blank">{{ $download->file }}</a> <br> <br>
            @endif
            {!! Form::file('file', null, ['class' => 'form-control', 'required']) !!}
            <div class="progress">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('image', 'تصویر') !!} <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ ($download->image_url) ? $download->image_url : 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">انتخاب تصویر</span>
                        <span class="fileinput-exists">تغییر</span>
                        {!! ($download->image_url) ? Form::file('image') : Form::file('image', ['required']) !!}
                    </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>
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
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        @if (! $download->file_url)
        if (!form.file.value) {
            alert('File not found');
            return false;
        }
        @endif
    }
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
 
    $('form').ajaxForm({
        beforeSubmit: validate,
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[name=file]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'در حال ذخیره سازی';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
            window.location.href = "{{ route('admin.downloads.index') }}";
        }
    });
     
    })();
</script>
@endsection