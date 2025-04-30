@extends('layouts.app')

@section('content')
    <x-nav-menu />
    <main class="flex relative flex-1 h-full">
        <div id="background-banner" class="flex overflow-hidden absolute right-0 w-1/2 h-full shrink-0">
            <img src="{{ asset('app/assets/images/backgrounds/banner-subscription.png') }}" class="object-cover w-full h-full"
                alt="banner">
        </div>
        <section id="subscriptions-list"
            class="relative flex flex-col gap-5 mt-[50px] w-full max-w-[1280px] px-[75px] py-5 mx-auto">
            <h1 class="font-bold text-[28px] leading-[42px]">My Subscriptions</h1>
            <div id="list-container" class="flex flex-col gap-5 max-w-[800px] w-full">
                @foreach ($transactions as $transaction)
                    <div
                        class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                        <div class="flex items-center flex-1 gap-[14px]">
                            <div class="flex shrink-0 size-[50px]">
                                <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}"
                                    class="flex shrink-0 size-[50px]" alt="icon">
                            </div>
                            <div>
                                <p class="text-lg font-bold">Pro Talent</p>
                                <p class="text-obito-text-secondary">{{ $transaction->pricing->duration }} months duration
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col w-[100px] shrink-0 gap-1">
                            <div class="flex gap-1 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                    alt="icon">
                                <p class="text-sm">Price</p>
                            </div>
                            <p class="text-sm font-semibold">Rp
                                {{ number_format($transaction->grand_total_amount, thousands_separator: '.') }}</p>
                        </div>
                        <div class="flex flex-col w-[150px] shrink-0 gap-1">
                            <div class="flex gap-1 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" class="flex w-5 shrink-0"
                                    alt="icon">
                                <p class="text-sm">Started At</p>
                            </div>
                            <p class="text-sm font-semibold">
                                {{ \Carbon\Carbon::parse($transaction->started_at)->format('d F Y') }}</p>
                        </div>
                        <div class="flex items-center justify-center w-[75px] shrink-0">
                            <span
                                class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">{{ $transaction->ended_at < now() ? 'EXPIRED' : 'ACTIVE' }}</span>
                        </div>
                        <a href="{{ route('checkout.subscription-details', $transaction->id) }}"
                            class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                            <span class="font-semibold">Details</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="js/dropdown-navbar.js"></script>
@endsection
