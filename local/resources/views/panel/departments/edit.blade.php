@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $department->name }}
@endsection
@section('main')
    {!! Form::model($department , [
        'method' => 'PUT',
        'route' =>  ['admin.departments.update', $department->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.departments.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection