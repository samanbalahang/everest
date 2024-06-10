@extends('panel.layouts.main')
@section('title')
    افزودن استاد
@endsection
@section('main')
    {!! Form::model($lecturer , [
        'method' => 'POST',
        'route' =>  'admin.lecturers.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.lecturers.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection