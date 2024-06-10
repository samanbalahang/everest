@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $job->title }}
@endsection
@section('main')
    {!! Form::model($job , [
        'method' => 'PUT',
        'route' =>  ['admin.jobs.update', $job->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.jobs.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection