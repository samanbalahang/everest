<div class="row">
    @if (Auth::user()->email == 'laravel@arya.agency')
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('slug', 'نام') !!}
            {!! Form::text('slug', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('label', 'عنوان') !!}
            {!! Form::text('label', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            @php
                $featured = Collect(['0' => 'خیر', '1' => 'بله']);
            @endphp
            {!! Form::label('active', 'فعال') !!}
            {!! Form::select('active', $featured, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('desc', 'توضیحات') !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(function(){
      $('#desc').summernote({
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