@extends('site.layouts.main')
@section("seo")
<style>
    body {
        direction: rtl !important;
    }

    main header {
        padding: 1rem 0;
    }

    main header ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    main header>ul {
        display: flex;
        justify-content: flex-end;
    }

    main nav {
        background-color: #d4e7f5;

    }

    main nav>ul {
        display: flex;
    }

    main header a {
        text-decoration: none;
        color: #626262;
        padding: 1rem;
        display: block;
    }

    main h1 {
        font-size: 1rem !important;
    }

    main h2,
    h3,
    h4,
    h5,
    h5 {
        font-size: 0.8rem !important;
        font-weight: normal !important;
    }

    .mainMenu,
    .mainHeader {
        display: none;
    }

    :focus {
        outline: 0;
        border-color: #2260ff;
        box-shadow: 0 0 0 4px #b5c9fc;
    }

    .rtl {
        direction: rtl !important;
    }
</style>
@endsection
@section('title')
افزودن سیگنال
@endsection
@section('main')
<main>
    @include("site.signal.header")
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2>
                            لیست سیگنال ها
                        </h2>
                        <h3>
                            تعداد کل سیگنالهای دریافتی:
                            <span class="p-3 bg-warning d-inline-block">
                                {{$kolSignal}}
                                @php
                                    $kolkarbaran = 0;
                                @endphp
                            </span>
                            عدد.
                            توسط
                            <span class="p-3 bg-warning d-inline-block">
                            @if($kolSignalkarbarans->count()>0)
                                {{$kolSignalkarbarans->count()}}
                            @endif
                            </span>
                             کاربر
                        </h3>
                        <h3>
                            تعداد سیگنالهای امروز:
                            <span class="p-3 bg-warning d-inline-block">
                                {{$todaySignal}}
                            </span>
                            عدد.
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2>
                            لیست مشاوره ها
                        </h2>
                        <h3>
                            تعداد کل مشاوره ها:
                            <span class="p-3 bg-warning d-inline-block">
                                {{$kolMoshavereha}}
                            </span>
                            عدد.
                        </h3>
                        <h3>
                            تعداد مشاورهای امروز:
                            <span class="p-3 bg-warning d-inline-block">
                                {{$todayMoshavereh}}
                            </span>
                            عدد.
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2>
                            وضعیت سیگنالها
                        </h2>
                        <h3>
                            تعداد کل سیگنال ها:
                            <span class="p-3 bg-warning d-inline-block">
                                {{$kolSignal}}
                            </span>
                            عدد.
                        </h3>
                        <h3>
                            درحال بررسی توسط شاگرد
                            <span class="p-3 bg-warning d-inline-block">
                                {{$darhaleBarresi}}
                            </span>
                            عدد.
                        </h3>
                        <h3>
                            قراره بیاد
                            <span class="p-3 bg-warning d-inline-block">
                                {{$garareBiad}}
                            </span>
                            عدد.
                        </h3>
                        <h3>
                            بدون نتیجه
                            <span class="p-3 bg-warning d-inline-block">
                                {{$bedoneNatigeh}}
                            </span>
                            عدد.
                        </h3>
                        <h3>
                            منصرف شد
                            <span class="p-3 bg-warning d-inline-block">
                                {{$monSaferShood}}
                            </span>
                            عدد.
                        </h3>
                        <h3 class="bg-success p-3">
                            ثبت نام کرد
                            <span class="p-3 bg-warning d-inline-block">
                                {{$sabtenameKard}}
                            </span>
                            عدد.
                        </h3>
                    </div>
                </div>

                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2 class="text-center">
                            جنسیت:
                        </h2>
                        <canvas id="gender">

                        </canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2 class="text-center">
                            نحوه آشنایی:
                        </h2>
                        <canvas id="method">

                        </canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-3">
                    <div class="border rounded p-3">
                        <h2 class="text-center">
                            سر نخ:
                        </h2>
                        <canvas id="lead">

                        </canvas>
                    </div>
                </div>
                <div class="col-12 col-md-12 my-3">
                    <div class="border rounded p-3">
                        <h2 class="text-center">
                            دوره ها:
                        </h2>
                        <canvas id="doreha">

                        </canvas>
                    </div>
                </div>
                <div class="col-12 col-md-12      my-3">
                    <div class="border rounded p-3">
                        <h2 class="text-center">
                            منطقه:
                        </h2>
                        <canvas id="area">

                        </canvas>
                    </div>
                </div>



            </div>
        </div>



    </main>
    @endsection
    @section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const gender = document.getElementById('gender');
        genderdata = [{{$femalePercent}}, {{$malePercent}}];
        new Chart(gender, {
            type: 'bar',
            data: {
                labels: ['زن', 'مرد'],
                datasets: [{
                    label: '# درصد',
                    data: genderdata,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // AREA
        const area = document.getElementById('area');
        const arealabels = [@foreach($areanames as $area)
        "{{$area}}", @endforeach
        ];

        const areadata = [@foreach($theareas as $thearea)
        "{{$thearea}}", @endforeach
        ];
        console.log(arealabels);
        console.log(areadata);
        datas = []
        new Chart(area, {
            type: 'bar',
            data: {
                labels: arealabels,
                datasets: [{
                    label: '# نفر',
                    data: areadata,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //doreha
        const doreha = document.getElementById('doreha');
        const dorehalabels = [@foreach($dorehaName as $labels)
        "{{$labels}}", @endforeach
        ];
        const dorehadata = [@foreach($signaldors as $signaldor)
        "{{$signaldor}}", @endforeach
        ];

        new Chart(doreha, {
            type: 'bar',
            data: {
                labels: dorehalabels,
                datasets: [{
                    label: '# نفر',
                    data: dorehadata,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // METHOD
        const method = document.getElementById('method');
        const methodlabels = [@foreach($methodNames as $method)
        "{{$method}}", @endforeach
        ];
        const methoddata = [@foreach($ashnaeearray as $ashna)
        "{{$ashna}}", @endforeach
        ];
        new Chart(method, {
            type: 'bar',
            data: {
                labels: methodlabels,
                datasets: [{
                    label: '# نفر',
                    data: methoddata,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // LEAD
        const lead = document.getElementById('lead');
        const leadlabels = [@foreach($methodNames as $method)
        "{{$method}}", @endforeach
        ];
        const leads = [@foreach($lead as $ashna)
        "{{$ashna}}", @endforeach
        ];
        new Chart(lead, {
            type: 'bar',
            data: {
                labels: leadlabels,
                datasets: [{
                    label: '# نفر',
                    data: leads,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endsection