<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'تیتر') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('slug', 'نشانی') !!}
            {!! Form::text('slug', null, ['class' => 'form-control', 'required', 'onkeyup' => 'this.value = this.value.toLowerCase();']) !!}
        </div>
    </div>
</div>