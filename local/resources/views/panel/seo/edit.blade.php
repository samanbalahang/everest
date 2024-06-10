@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $seo->label }}
@endsection
@section('main')
    {!! Form::model($seo , [
        'method' => 'PUT',
        'route' =>  ['admin.seo.update', $seo->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.seo.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection