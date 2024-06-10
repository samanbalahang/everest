@extends('panel.layouts.main')
@section('title')
    افزودن منو
@endsection
@section('main')
    {!! Form::model($menu , [
        'method' => 'POST',
        'route' =>  'admin.menu.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.menu.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection