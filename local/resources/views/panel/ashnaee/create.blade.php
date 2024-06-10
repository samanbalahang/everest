@extends('panel.layouts.main')
@section('title')
    افزودن نحوه آشنایی
@endsection
@section('main')
    {!! Form::model($ashnaee , [
        'method' => 'POST',
        'route' =>  'admin.ashnaee.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.ashnaee.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection