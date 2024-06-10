@extends('panel.layouts.main')
@section('title')
    افزودن علاقه‌مندی
@endsection
@section('main')
    {!! Form::model($fav , [
        'method' => 'POST',
        'route' =>  'admin.favs.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.favs.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection