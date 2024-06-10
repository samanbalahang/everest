@extends('panel.layouts.main')
@section('title')
    افزودن تنظیمات
@endsection
@section('main')
    {!! Form::model($settings , [
        'method' => 'POST',
        'route' =>  'admin.settings.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.settings.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection