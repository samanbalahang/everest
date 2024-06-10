@extends('panel.layouts.main')
@section('title')
    ویرایش {{ $menu->title }}
@endsection
@section('main')
    {!! Form::model($menu , [
        'method' => 'PUT',
        'route' =>  ['admin.menu.update', $menu->id],
        'files' =>  TRUE
    ]) !!}
    
    @include('panel.menu.form')

    <button type="submit" class="btn btn-primary">
        ویرایش
    </button>

    {!! Form::close() !!}
@endsection