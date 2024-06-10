@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $slider->title }}
@endsection
@section('main')
    {!! Form::model($slider , [
        'method' => 'PUT',
        'route' =>  ['admin.sliders.update', $slider->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.sliders.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection