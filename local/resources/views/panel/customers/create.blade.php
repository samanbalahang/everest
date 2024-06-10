@extends('panel.layouts.main')
@section('title')
    افزودن مشتری
@endsection
@section('main')
    {!! Form::model($customer , [
        'method' => 'POST',
        'route' =>  'admin.customers.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.customers.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection