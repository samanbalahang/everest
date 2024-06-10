<footer>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6>درباره ما</h6>
                    <p>
                        {!! Setting::get('footer_about') !!}
                    </p>
                </div>
                <div class="col-md-3">
                    <h6>تماس با ما</h6>
                    <ul class="contact">
                        @if (Setting::get('email'))
                        <li>
                            <i class="fal fa-envelope"></i>
                            <a href="mailto:{{ Setting::get('email') }}">
                                {{ Setting::get('email') }}
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('phone'))
                        <li>
                            <i class="fal fa-phone"></i>
                            {{ Setting::get('phone') }}
                        </li>
                        @endif
                        @if (Setting::get('footer_clock'))
                        <li>
                            <i class="fal fa-clock"></i>
                            {{ Setting::get('footer_clock') }}
                        </li>
                        @endif
                        @if (Setting::get('website'))
                        <li>
                            <i class="fal fa-globe"></i>
                            <a href="http://{{ Setting::get('website') }}">
                                {{ Setting::get('website') }}
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('telegram'))
                        <li>
                            <i class="fal fa-paper-plane"></i>
                            <a href="{{ Setting::get('telegram') }}">
                                {{ Setting::get('telegram') }}
                            </a>
                        </li>
                        @endif
                        @if (Setting::get('mobile'))
                        <li>
                            <i class="fal fa-mobile"></i>
                            {{ Setting::get('mobile') }}
                        </li>
                        @endif
                        @if (Setting::get('address'))
                        <li>
                            <i class="fal fa-map-marker"></i>
                            {{ Setting::get('address') }}
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>برخی دوره ها</h6>
                    <ul class="articles">
                        @php
                            $all = \App\Course::all();
                            $shuf = $all->shuffle();
                            $courses = $shuf->take(20);
                        @endphp
                        @foreach ($courses as $item)
                        <li>
                            <a href="{{ route('site.courses.show', $item->slug) }}">
                                <h5>{{ $item->title }}</h5>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter" id="advice">
        <div class="container">
            <div class="row" style="align-items: center;">
                <div class="col-md-6">
                    <h5 class="mb-0">مشاوره رایگان کالج اورست</h5>
                    {{-- <p>شماره همراه خود را ثبت کنید. مشاورین ما در اولین فرصت با شما تماس خواهند گرفت.</p>
                    <div id="adviceForm" data-url="{{ route('site.advice') }}">
                        <input type="text" name="mobile" placeholder="شماره همراه خود را وارد کنید!" required>
                        <button type="submit" onclick="adviceSubmit()">
                            درخواست مشاوره
                        </button>
                        <div class="invalid"></div>
                    </div> --}}
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5 text-left">
                    {{-- <a href="#">
                        <img src="" alt="" class="img-fluid">
                    </a>
                    <a href="#">
                        <img src="" alt="" class="img-fluid">
                    </a>
                    <a href="#">
                        <img src="" alt="" class="img-fluid">
                    </a> --}}
                    <a href="{{ route('site.moshavere') }}" class="btn btn-primary">درخواست مشاوره</a>
                </div>
            </div>
        </div>
    </section>
    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-right">
                    <p>کلیه حقوق این سایت  برای کالج اورست محفوظ بوده و کپی برداری برای مقاصد تجاری مجاز نمی باشد.</p>
                </div>
                <div class="col-md-4 text-left">
                    <a href="{{ asset('sitemap.xml') }}" target="_blank">
                        نقشه سایت
                    </a>
                    <a href="{{ route('site.contact') }}">
                        تماس باما
                    </a>
                    <a href="{{ route('site.about') }}">
                        درباره ما
                    </a>
                </div>
            </div>
        </div>
    </section>
</footer>