<nav id="nav-guest" class="flex w-full bg-white border-b border-obito-grey">
    <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
        <div class="flex items-center gap-[50px]">
            <a href="{{ route('home') }}" class="flex shrink-0">
                <img src="{{ asset('app/assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
            </a>
            <ul class="flex gap-10 items-center">
                <li
                    class="{{ request()->routeIs('home') ? 'font-semibold' : '' }} transition-all duration-300 hover:font-semibold">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li
                    class="transition-all {{ request()->routeIs('pricing') ? 'font-semibold' : '' }} duration-300 hover:font-semibold">
                    <a href="{{ route('pricing') }}">Pricing</a>
                </li>
                <li
                    class="transition-all duration-300 {{ request()->routeIs('course.index') ? 'font-semibold' : '' }} hover:font-semibold">
                    <a href="{{ route('course.index') }}">Courses</a>
                </li>
                <li class="transition-all duration-300 hover:font-semibold">
                    <a href="#">Testimonials</a>
                </li>
            </ul>
        </div>
        @if (!Auth::check())
            <div class="flex gap-5 justify-end items-center">
                <a href="{{ route('pricing') }}" class="flex shrink-0">
                    <img src="{{ asset('app/assets/images/icons/device-message.svg') }}" class="flex shrink-0"
                        alt="icon">
                </a>
                <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
                <div class="flex gap-3 items-center">
                    <a href="{{ route('register') }}"
                        class="rounded-full border border-obito-grey py-3 px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Sign Up</span>
                    </a>
                    <a href="{{ route('login') }}"
                        class="rounded-full py-3 px-5 gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                        <span class="font-semibold text-white">My Account</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</nav>
