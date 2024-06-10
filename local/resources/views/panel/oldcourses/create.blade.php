@extends('panel.layouts.main')
@section('title')
    افزودن دوره
@endsection
@section('main')
    {!! Form::model($oldcourse , [
        'method' => 'POST',
        'route' =>  'admin.oldcourses.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.oldcourses.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection