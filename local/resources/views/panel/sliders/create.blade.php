@extends('panel.layouts.main')
@section('title')
    افزودن اسلاید
@endsection
@section('main')
    {!! Form::model($slider , [
        'method' => 'POST',
        'route' =>  'admin.sliders.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.sliders.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection