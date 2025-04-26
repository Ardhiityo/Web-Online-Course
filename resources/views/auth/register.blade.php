@extends('layouts.app')

@section('content')
    <main class="flex relative flex-1 h-full">
        <section class="flex flex-1 items-center py-5 px-5 pl-[calc(((100%-1280px)/2)+75px)]">
            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col h-fit w-[510px] shrink-0 rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px]">Upgrade Your Skills</h1>
                <label class="flex relative gap-3 items-center">
                    <button id="upload-photo" type="button"
                        class="relative w-[90px] h-[90px] flex rounded-full overflow-hidden border border-obito-grey focus:ring-obito-green transition-all duration-300">
                        <span
                            class="absolute top-1/2 left-1/2 text-sm font-semibold transform -translate-x-1/2 -translate-y-1/2">
                            Add <br>Photo
                        </span>
                        <img id="photo-preview" src="" class="hidden object-cover w-full h-full" alt="photo">
                    </button>
                    <button id="delete-photo" type="button"
                        class="rounded-full w-fit py-[6px] px-[10px] bg-obito-light-red font-bold text-xs text-obito-red hidden">DELETE
                        PHOTO</button>
                    <input id="hidden-input" type="file" accept="image/*" class="absolute opacity-0 -z-10">
                </label>
                <div class="flex flex-col gap-2">
                    <p>Complete Name</p>
                    <label class="relative group">
                        <input type="text"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your complete name" name="name">
                        <img src="{{ asset('app/assets/images/icons/profile.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p>Occupation</p>
                    <label class="relative group">
                        <input type="text"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your ocupation">
                        <img src="{{ asset('app/assets/images/icons/briefcase.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p>Email Address</p>
                    <label class="relative group">
                        <input type="email"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your valid email address" name="email">
                        <img src="{{ asset('app/assets/images/icons/sms.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p>Password</p>
                    <label class="relative group">
                        <input type="password"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your password" name="password">
                        <img src="{{ asset('app/assets/images/icons/shield-security.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                </div>
                <div class="flex flex-col gap-2">
                    <p>Confirm Password</p>
                    <label class="relative group">
                        <input type="password"
                            class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300"
                            placeholder="Type your password" name="password_confirmation">
                        <img src="{{ asset('app/assets/images/icons/shield-security.svg') }}"
                            class="flex absolute left-5 top-1/2 transform -translate-y-1/2 size-5 shrink-0" alt="icon">
                    </label>
                </div>
                <button type="submit"
                    class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                    <span class="font-semibold text-white">Create My Account</span>
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
