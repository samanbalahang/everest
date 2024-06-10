@extends('panel.layouts.main')
@section('title')
    افزودن نظر
@endsection
@section('main')
    {!! Form::model($testimonial , [
        'method' => 'POST',
        'route' =>  'admin.testimonials.store',
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.testimonials.form')

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection