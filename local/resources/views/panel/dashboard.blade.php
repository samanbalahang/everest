@extends('panel.layouts.main')
@section('title')
    داشبورد
@endsection
@section('main')
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-danger">
                            <i class="fa fa-user text-white"></i>
                        </span>
                    </div>
                    <div>
                        دانشجویان شاغل
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $students }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg btn-info">
                            <i class="fa fa-file-alt text-white"></i>
                        </span>
                    </div>
                    <div>
                        اخبار
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $news }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-success">
                            <i class="fa fa-book text-white"></i>
                        </span>
                    </div>
                    <div>
                        مقالات
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $articles }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-secondary">
                            <i class="fa fa-download text-white"></i>
                        </span>
                    </div>
                    <div>
                        دانلودها
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $downloads }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-primary">
                            <i class="fa fa-clone text-white"></i>
                        </span>
                    </div>
                    <div>
                        دوره ها
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $courses }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg btn-dark">
                            <i class="fa fa-certificate text-white"></i>
                        </span>
                    </div>
                    <div>
                        دوره های برگزار شده
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $olds }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-warning">
                            <i class="fa fa-user-secret text-white"></i>
                        </span>
                    </div>
                    <div>
                        اساتید
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $lecturers }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="m-r-10">
                        <span class="btn btn-circle btn-lg bg-purple">
                            <i class="fa fa-briefcase text-white"></i>
                        </span>
                    </div>
                    <div>
                        آگهی های استخدام
                    </div>
                    <div class="ml-auto">
                        <h2 class="m-b-0 font-light">{{ $jobs }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $m = App\Message::where('seen', 0)->get();
    @endphp
    @if ($m->count() > 0)
    <div class="alert alert-warning">
        شما {{ $m->count() }} پیام جدید دارید!
    </div>
    @endif
@endsection 