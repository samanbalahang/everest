@extends('panel.layouts.main')
@section('title')
    اعداد
@endsection
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {!! Form::model($numbers, [
        'route' => 'admin.numbers.store',
        'method' => 'post'
    ]) !!}
        <div class="row">
            @foreach ($numbers as $item)
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label($item->name, $item->label) !!}
                    {!! Form::number($item->name, $item->number, ['class' => 'form-control']) !!}
                </div>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">ذخیره</button>
    {!! Form::close() !!}
@endsection