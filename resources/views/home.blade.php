@extends('layouts.app')

@section('content')
    <x-nav-guest />
    <main class="flex flex-1 items-center py-[70px]">
        <div class="w-full flex gap-[77px] justify-between items-center pl-[calc(((100%-1280px)/2)+75px)]">
            <div class="flex flex-col max-w-[500px] gap-[50px]">
                <div class="flex flex-col gap-[30px]">
                    <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                        <img src="{{ asset('app/assets/images/icons/crown-green.svg') }}" class="flex w-5 shrink-0"
                            alt="icon">
                        <span class="text-sm font-bold">TRUSTED BY 500 FORTUNE ANGGA COMPANIES</span>
                    </p>
                    <div>
                        <h1 class="font-extrabold text-[50px] leading-[65px]">Upgrade Skills, <br>Get Higher Salary</h1>
                        <p class="leading-7 mt-[10px] text-obito-text-secondary">Materi terbaru disusun oleh professional
                            dan perusahaan besar agar lebih sesuai kebutuhan dan anda lorem dolorsi.</p>
                    </div>
                    <div class="flex items-center gap-[18px]">
                        <a href="{{ route('pricing') }}"
                            class="flex items-center rounded-full h-[67px] py-5 px-[30px] gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                            <span class="text-lg font-semibold text-white">Get Started</span>
                        </a>
                        <a href="#"
                            class="flex items-center rounded-full h-[67px] border border-obito-grey py-5 px-[30px] bg-white gap-[10px] hover:border-obito-green transition-all duration-300">
                            <img src="{{ asset('app/assets/images/icons/play-circle-fill.svg') }}"
                                class="flex size-8 shrink-0" alt="icon">
                            <span class="text-lg font-semibold">How It Works</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-[14px]">
                    <img src="{{ asset('app/assets/images/photos/group.png') }}" class="flex shrink-0 h-[50px]"
                        alt="group photo">
                    <div>
                        <div class="flex gap-1 items-center">
                            <div class="flex">
                                <img src="{{ asset('app/assets/images/icons/Star 1.svg') }}" class="flex w-5 shrink-0"
                                    alt="star">
                                <img src="{{ asset('app/assets/images/icons/Star 1.svg') }}" class="flex w-5 shrink-0"
                                    alt="star">
                                <img src="{{ asset('app/assets/images/icons/Star 1.svg') }}" class="flex w-5 shrink-0"
                                    alt="star">
                                <img src="{{ asset('app/assets/images/icons/Star 1.svg') }}" class="flex w-5 shrink-0"
                                    alt="star">
                                <img src="{{ asset('app/assets/images/icons/Star 1.svg') }}" class="flex w-5 shrink-0"
                                    alt="star">
                            </div>
                            <span class="font-bold">5.0</span>
                        </div>
                        <p class="mt-1 font-bold">Join Millions Developer</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex shrink-0 h-[590px] w-[666px] justify-end">
            <img src="{{ asset('app/assets/images/backgrounds/hero-image.png') }}" alt="hero-image">
        </div>
    </main>
@endsection
