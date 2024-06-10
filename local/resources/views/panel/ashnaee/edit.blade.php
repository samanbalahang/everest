@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $ashnaee->title }}
@endsection
@section('main')
    {!! Form::model($ashnaee , [
        'method' => 'PUT',
        'route' =>  ['admin.ashnaee.update', $ashnaee->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.ashnaee.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection