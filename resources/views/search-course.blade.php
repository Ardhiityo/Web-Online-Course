@extends('layouts.app')

@section('content')
    <x-nav-profile />
    <x-nav-menu />
    <main class="flex flex-col gap-10 pb-10 mt-[50px]">
        <div class="flex flex-col items-center gap-[10px] max-w-[500px] w-full mx-auto">
            <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                <img src="{{ asset('app/assets/images/icons/crown-green.svg') }}" class="flex w-5 shrink-0" alt="icon">
                <span class="text-sm font-bold">GROW CAREER</span>
            </p>
            <h1 class="font-bold text-[28px] leading-[42px] text-center">Explore Our Greatest Courses</h1>
            <form action="{{ route('course-search') }}" class="relative">
                <label class="group">
                    <input type="text" name="keywords"
                        class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[550px] py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]"
                        placeholder="Search course by name">
                    <button type="submit"
                        class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                        <img src="{{ asset('app/assets/images/icons/search-normal-green-fill.svg') }}"
                            class="flex w-10 h-10 shrink-0" alt="">
                    </button>
                </label>
            </form>
        </div>
        <section id="result" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-5 mx-auto">
            <h2 class="font-bold text-[22px] leading-[33px]">Search Result: {{ request()->query('keywords') }}</h2>
            <div id="result-list" class="grid grid-cols-4 gap-5 tab-content">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('app/js/dropdown-navbar.js') }}"></script>
@endpush
