@extends('panel.layouts.main')
@section('title')
    افزودن تنظیمات سئو
@endsection
@section('main')
    {!! Form::model($seo , [
        'method' => 'POST',
        'route' =>  'admin.seo.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.seo.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection