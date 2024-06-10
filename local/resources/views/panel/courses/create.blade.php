@extends('panel.layouts.main')
@section('title')
    افزودن دوره
@endsection
@section('main')
    {!! Form::model($course , [
        'method' => 'POST',
        'route' =>  'admin.courses.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.courses.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection