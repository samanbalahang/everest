@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $customer->name }}
@endsection
@section('main')
    {!! Form::model($customer , [
        'method' => 'PUT',
        'route' =>  ['admin.customers.update', $customer->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.customers.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection