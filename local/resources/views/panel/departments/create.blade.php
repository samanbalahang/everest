@extends('panel.layouts.main')
@section('title')
    افزودن دپارتمان
@endsection
@section('main')
    {!! Form::model($department , [
        'method' => 'POST',
        'route' =>  'admin.departments.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.departments.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection