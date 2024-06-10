@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $pages->title }}
@endsection
@section('main')
    {!! Form::model($pages , [
        'method' => 'PUT',
        'route' =>  ['admin.pages.update', $pages->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.pages.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection