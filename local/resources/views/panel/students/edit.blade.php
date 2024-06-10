@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $student->name }}
@endsection
@section('main')
    {!! Form::model($student , [
        'method' => 'PUT',
        'route' =>  ['admin.students.update', $student->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.students.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection