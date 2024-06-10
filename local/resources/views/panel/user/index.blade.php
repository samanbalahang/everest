@extends('panel.layouts.main')
@section('title')
    تنظیمات کاربری
@endsection
@section('main')
    {!! Form::model($user , [
        'method' => 'PUT',
        'route' =>  ['admin.user.update', Auth::user()->id],
        'files' =>  TRUE
    ]) !!}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('password', 'رمز عبور') !!}
                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('password2', 'تکرار رمز عبور') !!}
                {!! Form::password('password2', ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection