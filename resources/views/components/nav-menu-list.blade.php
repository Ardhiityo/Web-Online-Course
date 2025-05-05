<li class="group {{ request()->routeIs('course.index') ? 'active' : '' }}">
    <a href="{{ route('course.index') }}"
        class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
        <img src="{{ asset('app/assets/images/icons/home-trend-up.svg') }}" class="flex w-5 shrink-0" alt="icon">
        <span>Overview</span>
    </a>
</li>
<li class="group {{ request()->routeIs('course.search') ? 'active' : '' }}">
    <a href="{{ route('course.search') }}"
        class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
        <img src="{{ asset('app/assets/images/icons/note-favorite.svg') }}" class="flex w-5 shrink-0" alt="icon">
        <span>Courses</span>
    </a>
</li>
<li class="group">
    <a href="#"
        class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
        <img src="{{ asset('app/assets/images/icons/message-programming.svg') }}" class="flex w-5 shrink-0"
            alt="icon">
        <span>Quizzess</span>
    </a>
</li>
<li class="group">
    <a href="#"
        class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
        <img src="{{ asset('app/assets/images/icons/cup.svg') }}" class="flex w-5 shrink-0" alt="icon">
        <span>Certificates</span>
    </a>
</li>
<li class="group">
    <a href="#"
        class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
        <img src="{{ asset('app/assets/images/icons/ruler&pen.svg') }}" class="flex w-5 shrink-0" alt="icon">
        <span>Portfolios</span>
    </a>
</li>
