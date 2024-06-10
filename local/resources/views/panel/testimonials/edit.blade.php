@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $testimonial->name }}
@endsection
@section('main')
    {!! Form::model($testimonial , [
        'method' => 'PUT',
        'route' =>  ['admin.testimonials.update', $testimonial->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.testimonials.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection