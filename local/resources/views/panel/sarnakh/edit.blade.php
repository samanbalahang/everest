@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $sarnakh->title }}
@endsection
@section('main')
    {!! Form::model($sarnakh , [
        'method' => 'PUT',
        'route' =>  ['admin.sarnakh.update', $sarnakh->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.sarnakh.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection