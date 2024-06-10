@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $news->title }}
@endsection
@section('main')
    {!! Form::model($news , [
        'method' => 'PUT',
        'route' =>  ['admin.news.update', $news->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.news.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection