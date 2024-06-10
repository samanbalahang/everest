@extends('panel.layouts.main')
@section('title')
    افزودن درباره
@endsection
@section('main')
    {!! Form::model($about , [
        'method' => 'POST',
        'route' =>  'admin.abouts.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.abouts.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection