@extends('panel.layouts.main')
@section('title')
    پیام از {{ $moshavere->name }}
@endsection
@section('main')
    <div class="row align-items-center">
        <div class="col-md-3">
            <p>
                <span>نام :</span>
                <strong>{{ $moshavere->name }}</strong>
            </p>
        </div>
        <div class="col-md-3">
            <p>
                <span>شماره همراه :</span>
                <strong>{{ $moshavere->mobile }}</strong>
            </p>
        </div>
    </div>
    <p>
        <span>متن پیام :</span>
    </p>
    <div class="card">
        <div class="card-body">
            <p>
                {{ $moshavere->moshavere }}
            </p>
        </div>
    </div>
@endsection