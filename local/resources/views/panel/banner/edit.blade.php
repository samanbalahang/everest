@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $banner->label }}
@endsection
@section('main')
    {!! Form::model($banner , [
        'method' => 'PUT',
        'route' =>  ['admin.banner.update', $banner->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.banner.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection