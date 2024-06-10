@extends('panel.layouts.main')
@section('title')
    افزودن سرنخ
@endsection
@section('main')
    {!! Form::model($sarnakh , [
        'method' => 'POST',
        'route' =>  'admin.sarnakh.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.sarnakh.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection