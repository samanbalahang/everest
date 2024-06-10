@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $downloadcat->title }}
@endsection
@section('main')
    {!! Form::model($downloadcat , [
        'method' => 'PUT',
        'route' =>  ['admin.downloadscat.update', $downloadcat->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.downloadscat.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection