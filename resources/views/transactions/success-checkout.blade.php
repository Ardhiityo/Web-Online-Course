@extends('layouts.app')

@section('content')
    <x-nav-profile />
    <x-nav-menu />
    <main class="flex flex-1 justify-center items-center py-5">
        <div class="w-[500px] flex flex-col gap-[30px]">
            <div class="flex flex-col gap-[10px]">
                <div class="rounded-full !w-fit mx-auto py-2 px-[14px] bg-obito-light-green flex items-center gap-[6px]">
                    <img src="{{ asset('app/assets/images/icons/crown-green.svg') }}" alt="icon"
                        class="size-[20px] shrink-0" />
                    <p class="font-bold text-sm leading-[21px]">{{ strtoupper($transaction->pricing->name) }} UNLOCKED</p>
                </div>
                <h1 class="font-bold text-[28px] leading-[42px] text-center">Payment Successful</h1>
                <p class="text-center leading-[28px] text-obito-text-secondary">Anda telah memiliki akses kelas materi
                    terbaru sebagai persiapan bekerja di era digital industri saat ini, yay!</p>
            </div>
            <section id="card"
                class="relative rounded-[20px] border border-obito-grey p-[10px] flex items-center gap-4 bg-white">
                <div class="flex items-center justify-center rounded-[14px] overflow-hidden w-[180px] h-[130px]">
                    <img src="{{ asset('app/assets/images/thumbnails/succes-checkout.png') }}" alt="image"
                        class="object-cover w-full h-full" />
                </div>
                <div class="flex flex-col gap-[10px]">
                    <h2 class="font-bold">
                        Subscription Active: <br />
                        {{ $transaction->pricing->name }} Talent Digital Era 2025
                    </h2>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('app/assets/images/icons/calendar-green.svg') }}" alt="icon"
                            class="size-[20px] shrink-0" />
                        <p class="text-obito-text-secondary text-sm leading-[21px]">{{ $transaction->pricing->duration }}
                            Months Access</p>
                    </div>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ asset('app/assets/images/icons/briefcase-green.svg') }}" alt="icon"
                            class="size-[20px] shrink-0" />
                        <p class="text-obito-text-secondary text-sm leading-[21px]">Job-Ready Skills</p>
                    </div>
                </div>
                <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}" alt="icon"
                    class="absolute top-1/2 right-0 size-[50px] shrink-0 -translate-y-1/2 translate-x-1/2" />
            </section>
            <div class="flex items-center gap-[14px] mx-auto">
                <a href="{{ route('checkout.my-subscription') }}">
                    <div
                        class="flex items-center px-5 justify-center border border-obito-grey rounded-full py-[10px] bg-white hover:border-obito-green transition-all duration-300">
                        <p class="font-semibold">My Transactions</p>
                    </div>
                </a>
                <a href="{{ route('course', ['catalog' => $slug]) }}">
                    <div
                        class="flex items-center px-5 justify-center text-white rounded-full py-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                        <p class="font-semibold">Start Learning</p>
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="js/dropdown-navbar.js"></script>
@endpush
