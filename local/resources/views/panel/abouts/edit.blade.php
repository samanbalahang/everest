@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $about->title }}
@endsection
@section('main')
    {!! Form::model($about , [
        'method' => 'PUT',
        'route' =>  ['admin.abouts.update', $about->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.abouts.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection