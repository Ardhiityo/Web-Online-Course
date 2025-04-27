@extends('layouts.app')

@section('content')
    <nav id="bottom-nav" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <ul class="flex w-full max-w-[1280px] px-[75px] mx-auto gap-3">
            <li class="group">
                <a href="#"
                    class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="{{ asset('app/assets/images/icons/home-trend-up.svg') }}" class="flex w-5 shrink-0"
                        alt="icon">
                    <span>Overview</span>
                </a>
            </li>
            <li class="group">
                <a href="catalog-v2.html"
                    class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="{{ asset('app/assets/images/icons/note-favorite.svg') }}" class="flex w-5 shrink-0"
                        alt="icon">
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
                    <img src="{{ asset('app/assets/images/icons/ruler&pen.svg') }}" class="flex w-5 shrink-0"
                        alt="icon">
                    <span>Portfolios</span>
                </a>
            </li>
        </ul>
    </nav>
    <main class="flex relative flex-1 h-full">
        <div id="background-banner" class="flex overflow-hidden absolute right-0 w-1/2 h-full shrink-0">
            <img src="{{ asset('app/assets/images/backgrounds/banner-subscription.png') }}"
                class="object-cover w-full h-full" alt="banner">
        </div>
        <section id="subscriptions-list"
            class="relative flex flex-col gap-5 mt-[50px] w-full max-w-[1280px] px-[75px] py-5 mx-auto">
            <h1 class="font-bold text-[28px] leading-[42px]">My Subscriptions</h1>
            <div id="list-container" class="flex flex-col gap-5 max-w-[800px] w-full">
                <div
                    class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                    <div class="flex items-center flex-1 gap-[14px]">
                        <div class="flex shrink-0 size-[50px]">
                            <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}"
                                class="flex shrink-0 size-[50px]" alt="icon">
                        </div>
                        <div>
                            <p class="text-lg font-bold">Pro Talent</p>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-[100px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Price</p>
                        </div>
                        <p class="text-sm font-semibold">Rp 1.890.000</p>
                    </div>
                    <div class="flex flex-col w-[150px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Started At</p>
                        </div>
                        <p class="text-sm font-semibold">19 December 2024</p>
                    </div>
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span
                            class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">ACTIVE</span>
                    </div>
                    <a href="subscription-details.html"
                        class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Details</span>
                    </a>
                </div>
                <div
                    class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                    <div class="flex items-center flex-1 gap-[14px]">
                        <div class="flex shrink-0 size-[50px]">
                            <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}"
                                class="flex shrink-0 size-[50px]" alt="icon">
                        </div>
                        <div>
                            <p class="text-lg font-bold">Pro Talent</p>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-[100px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Price</p>
                        </div>
                        <p class="text-sm font-semibold">Rp 1.890.000</p>
                    </div>
                    <div class="flex flex-col w-[150px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Started At</p>
                        </div>
                        <p class="text-sm font-semibold">19 December 2024</p>
                    </div>
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span
                            class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                    </div>
                    <a href="subscription-details.html"
                        class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Details</span>
                    </a>
                </div>
                <div
                    class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                    <div class="flex items-center flex-1 gap-[14px]">
                        <div class="flex shrink-0 size-[50px]">
                            <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}"
                                class="flex shrink-0 size-[50px]" alt="icon">
                        </div>
                        <div>
                            <p class="text-lg font-bold">Pro Talent</p>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-[100px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Price</p>
                        </div>
                        <p class="text-sm font-semibold">Rp 1.890.000</p>
                    </div>
                    <div class="flex flex-col w-[150px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Started At</p>
                        </div>
                        <p class="text-sm font-semibold">19 December 2024</p>
                    </div>
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span
                            class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                    </div>
                    <a href="subscription-details.html"
                        class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Details</span>
                    </a>
                </div>
                <div
                    class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                    <div class="flex items-center flex-1 gap-[14px]">
                        <div class="flex shrink-0 size-[50px]">
                            <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}"
                                class="flex shrink-0 size-[50px]" alt="icon">
                        </div>
                        <div>
                            <p class="text-lg font-bold">Pro Talent</p>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-[100px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Price</p>
                        </div>
                        <p class="text-sm font-semibold">Rp 1.890.000</p>
                    </div>
                    <div class="flex flex-col w-[150px] shrink-0 gap-1">
                        <div class="flex gap-1 items-center">
                            <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                alt="icon">
                            <p class="text-sm">Started At</p>
                        </div>
                        <p class="text-sm font-semibold">19 December 2024</p>
                    </div>
                    <div class="flex items-center justify-center w-[75px] shrink-0">
                        <span
                            class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                    </div>
                    <a href="subscription-details.html"
                        class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <span class="font-semibold">Details</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="js/dropdown-navbar.js"></script>
@endsection
