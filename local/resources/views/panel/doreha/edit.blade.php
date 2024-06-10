@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $doreha->title }}
@endsection
@section('main')
    {!! Form::model($doreha , [
        'method' => 'PUT',
        'route' =>  ['admin.doreha.update', $doreha->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.doreha.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection