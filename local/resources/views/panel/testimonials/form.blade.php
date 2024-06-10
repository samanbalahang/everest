<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'نام و نام خانوادگی') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('course', 'دوره') !!}
            {!! Form::text('course', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('video', 'ویدئو') !!} <br>
            {!! Form::file('video', null, ['class' => 'form-control', 'required']) !!}
            <div class="progress">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        @if (! $testimonial->video)
        if (!form.video.value) {
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
            var posterValue = $('input[name=video]').fieldValue();
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
            window.location.href = "{{ route('admin.testimonials.index') }}";
        }
    });
     
    })();
</script>
@endsection