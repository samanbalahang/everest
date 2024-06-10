@extends('panel.layouts.main')
@section('title')
    افزودن برگه
@endsection
@section('main')
    {!! Form::model($pages , [
        'method' => 'POST',
        'route' =>  'admin.pages.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.pages.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection