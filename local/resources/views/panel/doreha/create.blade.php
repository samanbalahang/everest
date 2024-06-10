@extends('panel.layouts.main')
@section('title')
    افزودن دوره
@endsection
@section('main')
    {!! Form::model($doreha , [
        'method' => 'POST',
        'route' =>  'admin.doreha.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.doreha.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection