@extends('panel.layouts.main')
@section('title')
    افزودن دانشجو
@endsection
@section('main')
    {!! Form::model($student , [
        'method' => 'POST',
        'route' =>  'admin.students.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.students.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection