@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $fav->title }}
@endsection
@section('main')
    {!! Form::model($fav , [
        'method' => 'PUT',
        'route' =>  ['admin.favs.update', $fav->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.favs.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection