@extends('panel.layouts.main')
@section('title')
    افزودن نحوه
@endsection
@section('main')
    {!! Form::model($method , [
        'method' => 'POST',
        'route' =>  'admin.methods.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.methods.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection