@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $lecturer->name }}
@endsection
@section('main')
    {!! Form::model($lecturer , [
        'method' => 'PUT',
        'route' =>  ['admin.lecturers.update', $lecturer->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.lecturers.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection