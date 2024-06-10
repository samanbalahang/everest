@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $course->title }}
@endsection
@section('main')
    {!! Form::model($course , [
        'method' => 'PUT',
        'route' =>  ['admin.courses.update', $course->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.courses.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection