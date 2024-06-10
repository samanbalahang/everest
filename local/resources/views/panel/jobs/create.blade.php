@extends('panel.layouts.main')
@section('title')
    افزودن آگهی
@endsection
@section('main')
    {!! Form::model($job , [
        'method' => 'POST',
        'route' =>  'admin.jobs.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.jobs.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection