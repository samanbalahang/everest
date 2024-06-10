@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $method->title }}
@endsection
@section('main')
    {!! Form::model($method , [
        'method' => 'PUT',
        'route' =>  ['admin.methods.update', $method->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.methods.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection