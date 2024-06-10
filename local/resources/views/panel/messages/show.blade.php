@extends('panel.layouts.main')
@section('title')
    پیام از {{ $message->name }}
@endsection
@section('main')
    <div class="row align-items-center">
        <div class="col-md-3">
            <p>
                <span>نام :</span>
                <strong>{{ $message->name }}</strong>
            </p>
        </div>
        <div class="col-md-3">
            <p>
                <span>شماره همراه :</span>
                <strong>{{ $message->mobile }}</strong>
            </p>
        </div>
        <div class="col-md-3">
            <p>
                <span>ایمیل :</span>
                <strong>{{ $message->email }}</strong>
            </p>
        </div>
        <div class="col-md-3">
            <p>
                <span>ضمیمه :</span>
                @if ($message->file_url)
                    <a href="{{ $message->file_url }}" class="btn btn-primary" target="_blank">
                        دانلود
                    </a>
                @else
                    <strong>ندارد</strong>
                @endif
            </p>
        </div>
    </div>
    <p>
        <span>متن پیام :</span>
    </p>
    <div class="card">
        <div class="card-body">
            <p>
                {{ $message->message }}
            </p>
        </div>
    </div>
@endsection