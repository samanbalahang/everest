<header>
        <ul>
            <li>
                <a href="#">
                    <i class="fas fa-user"></i>
                    {{$karbaran->karbar_name}} {{$karbaran->karbar_lname}}
                </a>
            </li>
        </ul>
        <nav>
            <ul>
                <li>
                <li>
                    <a class="text-center rtl" href="{{route('site.signal.amar')}}">
                        آمار
                    </a>
                </li>
                </li>
                <li>
                    <a class="text-center rtl" href="{{route('site.signal.create',"newuser=1")}}">
                        ثبت سیگنال
                    </a>
                </li>
                <li>
                    @switch($karbaran->karbar_role)
                    @case(0)
                    @break
                    @case(1)
                    <a href="{{route("site.signal.list")}}" class="">
                        لیست سیگنال ها
                    </a>
                    @break
                    @case(2)
                    <a href="{{route("site.signal.list")}}" class="">
                        لیست سیگنال ها
                    </a>
                    @break
                    @endswitch
                </li>
                <li>
                    @switch($karbaran->karbar_role)
                    @case(0)
                    @break
                    @case(1)
                    <a href="{{route("site.signal.amar.karbaran")}}" class="">
                        آمار کاربران
                    </a>
                    @break
                    @case(2)
                    <a href="{{route("site.signal.amar.karbaran")}}" class="">
                        آمار کاربران    
                    </a>
                    @break
                    @endswitch
                </li>
                <li>
                    @switch($karbaran->karbar_role)
                    @case(0)
                    @break
                    @case(1)
                    <a href="{{route("site.signal.phone.numbers")}}" class="">
                        سامانه پیام کوتاه
                    </a>
                    @break
                    @case(2)
                    <a href="{{route("site.signal.phone.numbers")}}" class="">
                        سامانه پیام کوتاه   
                    </a>
                    @break
                    @endswitch
                </li>
                <li class="mr-auto">
                    <a class="text-center rtl" href="{{route('site.signal.login',"newuser=1")}}">
                        خروج:
                    </a>
                </li>
            </ul>
        </nav>
    </header>