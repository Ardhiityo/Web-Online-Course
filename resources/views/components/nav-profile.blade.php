<nav id="nav-auth" class="flex w-full bg-white border-b border-obito-grey">
    <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
        <div class="flex items-center gap-[30px]">
            <a href="{{ route('home') }}" class="flex shrink-0">
                <img src="{{ asset('app/assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
            </a>
            <form action="{{ route('course-search') }}" class="relative">
                <label class="group">
                    <input type="text" name="keywords"
                        class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[400px]  py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]"
                        placeholder="Search course by name">
                    <button type="submit"
                        class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                        <img src="{{ asset('app/assets/images/icons/search-normal-green-fill.svg') }}"
                            class="flex w-10 h-10 shrink-0" alt="">
                    </button>
                </label>
            </form>
        </div>
        <div class="flex gap-5 justify-end items-center">
            <a href="#" class="flex shrink-0">
                <img src="{{ asset('app/assets/images/icons/device-message.svg') }}" class="flex shrink-0"
                    alt="icon">
            </a>
            <a href="catalog-v2.html" class="flex shrink-0">
                <img src="{{ asset('app/assets/images/icons/category.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <a href="#" class="flex shrink-0">
                <img src="{{ asset('app/assets/images/icons/notification.svg') }}" class="flex shrink-0" alt="icon">
            </a>
            <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
            <div id="profile-dropdown" class="relative flex items-center gap-[14px]">
                <div class="flex shrink-0 w-[50px] h-[50px] rounded-full overflow-hidden bg-obito-grey">
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="object-cover w-full h-full"
                        alt="photo">
                </div>
                <div>
                    <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-obito-text-secondary">{{ Auth::user()->occupation }}</p>
                </div>
                <button id="dropdown-opener" class="flex w-6 h-6 shrink-0">
                    <img src="{{ asset('app/assets/images/icons/arrow-circle-down.svg') }}" class="w-6 h-6"
                        alt="icon">
                </button>
                <div id="dropdown"
                    class="absolute top-full right-0 mt-[7px] w-[170px] h-fit bg-white rounded-xl border border-obito-grey py-4 px-5 shadow-[0px_10px_30px_0px_#B8B8B840] z-10 hidden">
                    <ul class="flex flex-col gap-[14px]">
                        <li class="transition-all duration-300 hover:text-obito-green">
                            <a href="{{ route('course') }}">My Courses</a>
                        </li>
                        <li class="transition-all duration-300 hover:text-obito-green">
                            <a href="#">Certificates</a>
                        </li>
                        <li class="transition-all duration-300 hover:text-obito-green">
                            <a href="{{ route('checkout.my-subscription') }}">Subscriptions</a>
                        </li>
                        <li class="transition-all duration-300 hover:text-obito-green">
                            <a href="#" id="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<form action="{{ route('logout') }}" id="form-logout" method="post">
    @csrf
</form>

@push('scripts')
    <script>
        const logout = document.getElementById('logout');
        logout.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('form-logout').submit();
        })
    </script>
@endpush
