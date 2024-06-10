@extends('panel.layouts.main')
@section('title')
    افزودن دانلود
@endsection
@section('main')
    {!! Form::model($download , [
        'method' => 'POST',
        'route' =>  'admin.downloads.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.downloads.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection