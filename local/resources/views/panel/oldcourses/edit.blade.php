@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $oldcourse->title }}
@endsection
@section('main')
    {!! Form::model($oldcourse , [
        'method' => 'PUT',
        'route' =>  ['admin.oldcourses.update', $oldcourse->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.oldcourses.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection