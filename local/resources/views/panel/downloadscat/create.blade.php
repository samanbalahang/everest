@extends('panel.layouts.main')
@section('title')
    افزودن دسته بندی
@endsection
@section('main')
    {!! Form::model($downloadcat , [
        'method' => 'POST',
        'route' =>  'admin.downloadscat.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.downloadscat.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection