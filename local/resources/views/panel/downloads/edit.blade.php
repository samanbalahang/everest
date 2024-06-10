@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $download->title }}
@endsection
@section('main')
    {!! Form::model($download , [
        'method' => 'PUT',
        'route' =>  ['admin.downloads.update', $download->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.downloads.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection