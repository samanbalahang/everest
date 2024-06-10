@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $jobcat->title }}
@endsection
@section('main')
    {!! Form::model($jobcat , [
        'method' => 'PUT',
        'route' =>  ['admin.jobscat.update', $jobcat->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.jobscat.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection