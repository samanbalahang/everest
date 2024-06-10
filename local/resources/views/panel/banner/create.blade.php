@extends('panel.layouts.main')
@section('title')
    افزودن متن
@endsection
@section('main')
    {!! Form::model($banner , [
        'method' => 'POST',
        'route' =>  'admin.banner.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.banner.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection