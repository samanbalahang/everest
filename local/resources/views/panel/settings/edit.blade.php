@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $settings->label }}
@endsection
@section('main')
    {!! Form::model($settings , [
        'method' => 'PUT',
        'route' =>  ['admin.settings.update', $settings->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.settings.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection