@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $articlecat->title }}
@endsection
@section('main')
    {!! Form::model($articlecat , [
        'method' => 'PUT',
        'route' =>  ['admin.articlescat.update', $articlecat->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.articlescat.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection