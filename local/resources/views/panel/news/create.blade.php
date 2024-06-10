@extends('panel.layouts.main')
@section('title')
    افزودن خبر
@endsection
@section('main')
    {!! Form::model($news , [
        'method' => 'POST',
        'route' =>  'admin.news.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.news.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection