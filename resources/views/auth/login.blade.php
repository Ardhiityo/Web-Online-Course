@extends('layouts.app')

@section('title', 'Login - Obito Online Learning Platform')

@section('content')
    <x-nav-guest />
    <main class="flex relative flex-1 h-full">
        <section class="flex flex-1 items-center py-5 px-5 pl-[calc(((100%-1280px)/2)+75px)]">
            <form action="{{ route('login') }}" method="POST"
                class="flex flex-col h-fit w-[510px] shrink-0 rounded-[20px] border border-obito-grey p-5 gap-5 bg-white">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px] mb-5">Welcome Back, <br>Let’s Upgrade Skills</h1>
                <div class="flex flex-col gap-2">
                    <p>Email Address</p>
                    <label class="relative group">
                        <input type="email"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your valid email address" name="email">
                        <img src="{{ asset('app/assets/images/icons/sms.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </label>
                </div>
                <div class="flex flex-col gap-3">
                    <p>Password</p>
                    <label class="relative group">
                        <input type="password"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your password" name="password">
                        <img src="{{ asset('app/assets/images/icons/shield-security.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-obito-green hover:underline">Forgot My
                        Password</a>
                </div>
                <button type="submit"
                    class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">Sign In to My Account</span>
                </button>
            </form>
        </section>
        <div class="flex relative w-1/2 shrink-0">
            <div id="background-banner" class="flex overflow-hidden absolute w-full h-full">
                <img src="{{ asset('app/assets/images/backgrounds/banner-subscription.png') }}"
                    class="object-cover w-full h-full" alt="banner">
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('app/js/dropdown-navbar.js') }}"></script>
    <script src="{{ asset('js/photo-upload.js') }}"></script>
@endpush
