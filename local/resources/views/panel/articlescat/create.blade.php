@extends('panel.layouts.main')
@section('title')
    افزودن دسته بندی
@endsection
@section('main')
    {!! Form::model($articlecat , [
        'method' => 'POST',
        'route' =>  'admin.articlescat.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.articlescat.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection