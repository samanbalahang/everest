@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $article->title }}
@endsection
@section('main')
    {!! Form::model($article , [
        'method' => 'PUT',
        'route' =>  ['admin.articles.update', $article->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.articles.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection