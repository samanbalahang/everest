@extends('panel.layouts.main')
@section('title')
    افزودن دسته بندی
@endsection
@section('main')
    {!! Form::model($jobcat , [
        'method' => 'POST',
        'route' =>  'admin.jobscat.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.jobscat.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection