<div class="row">
    @if (Auth::user()->email == 'laravel@arya.agency')
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'نام') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('label', 'عنوان') !!}
            {!! Form::text('label', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
                $types = Collect(['string' => 'کلمه', 'file' => 'تصویر', 'text' => 'متن', 'radio' => 'بله/خیر']);
            @endphp
            {!! Form::label('type', 'نوع') !!}
            {!! Form::select('type', $types, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
                $show = Collect(['0' => 'عدم نمایش', '1' => 'نمایش']);
            @endphp
            {!! Form::label('show', 'وضعیت') !!}
            {!! Form::select('show', $show, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    @endif
    @if ($settings->type == 'string')
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('value', 'مقدار') !!}
            {!! Form::text('value', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    @elseif ($settings->type == 'file')
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('value', 'تصویر') !!} <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ ($settings->image_url) ? $settings->image_url : 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">انتخاب تصویر</span>
                        <span class="fileinput-exists">تغییر</span>
                        {!! Form::file('value') !!}
                    </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                </div>
            </div>
        </div>
    </div>
    @elseif ($settings->type == 'text')
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('text', 'متن') !!}
            {!! Form::textarea('text', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    @elseif ($settings->type == 'radio')
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('no', 'خیر') !!}
            @if ($settings->value == 'no')
            {!! Form::radio('value', 'no', true) !!}
            @else
            {!! Form::radio('value', 'no') !!}
            @endif
            {!! Form::label('yes', 'بله') !!}
            @if ($settings->value == 'yes')
            {!! Form::radio('value', 'yes', true) !!}
            @else
            {!! Form::radio('value', 'yes') !!}
            @endif
        </div>
    </div>
    @endif
</div>
@section('scripts')
<script>
    $(function(){
      $('#text').summernote({
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