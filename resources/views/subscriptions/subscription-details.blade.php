@extends('layouts.app')

@section('content')
    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5">
            <a href="#" class="last-of-type:font-semibold">Dashboard</a>
            <div class="w-px h-10 bg-obito-grey"></div>
            <a href="my-subscriptions.html" class="last-of-type:font-semibold">My Subscriptions</a>
            <span class="text-obito-grey">/</span>
            <a href="#" class="last-of-type:font-semibold">Details Subscription</a>
        </div>
    </div>
    <main class="flex flex-1 justify-center items-center py-5">
        <div class="flex w-[1000px] !h-fit rounded-[20px] border border-obito-grey gap-[40px] bg-white items-center p-5">
            <div id="details" class="flex flex-col gap-5 w-full">
                <h1 class="font-bold text-[22px] leading-[33px]">Details Subscription</h1>
                <section id="give-access-to" class="flex flex-col gap-2">
                    <div class="flex items-center justify-between rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="profile flex items-center gap-[14px]">
                            <img src="{{ asset('app/assets/images/icons/security-user-green-fill.svg') }}" alt="icon"
                                class="size-[50px] shrink-0" />
                            <div class="desc flex flex-col gap-[3px]">
                                <h3 class="text-sm leading-[21px] text-obito-text-secondary">Booking TRX ID</h3>
                                <p class="font-semibold">OBITOBWA10930949</p>
                            </div>
                        </div>
                        <div class="status flex items-center gap-[14px]">
                            <span
                                class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">ACTIVE</span>
                            <span
                                class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                        </div>
                    </div>
                </section>
                <section id="transaction-details" class="flex flex-col gap-[12px]">
                    <h2 class="font-semibold">Transaction Details</h2>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Subscription Package</p>
                            </div>
                            <strong class="font-semibold">Rp 1.899.000</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Access Duration</p>
                            </div>
                            <strong class="font-semibold">3 Months</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Started At</p>
                            </div>
                            <strong class="font-semibold">19 December 2024</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Ended At</p>
                            </div>
                            <strong class="font-semibold">19 March 2025</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>PPN 11%</p>
                            </div>
                            <strong class="font-semibold">Rp 189.000</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p class="whitespace-nowrap">Grand Total</p>
                            </div>
                            <strong class="font-bold text-obito-green text-[22px] leading-[33px]"> Rp 28.583.481 </strong>
                        </div>
                    </div>
                </section>
                <section id="access given-to" class="flex flex-col gap-2">
                    <h2 class="font-semibold">Access Given to</h2>
                    <div class="profile flex items-center gap-[14px] rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="flex justify-center items-center overflow-hidden size-[50px] rounded-full">
                            <img src="{{ asset('app/assets/images/photos/sami.png') }}" alt="image"
                                class="object-cover size-full" />
                        </div>
                        <div class="desc flex flex-col gap-[3px]">
                            <h3 class="font-semibold">Tamara Utami</h3>
                            <p class="text-sm leading-[21px] text-obito-text-secondary">Programmer UI</p>
                        </div>
                    </div>
                </section>
            </div>
            <div id="benefits" class="bg-[#F8FAF9] rounded-[20px] overflow-hidden shrink-0 w-[420px]">
                <section id="thumbnails"
                    class="relative flex justify-center h-[250px] items-center overflow-hidden rounded-t-[14px] w-full">
                    <img src="{{ asset('app/assets/images/thumbnails/checkout.png') }}" alt="image"
                        class="object-cover size-full" />
                </section>
                <section id="points" class="pt-[61px] relative flex flex-col gap-4 px-5 pb-5">
                    <div
                        class="card absolute -top-[47px] left-[30px] right-[30px] flex items-center p-4 gap-[14px] border border-obito-grey rounded-[20px] bg-white shadow-[0px_10px_30px_0px_#B8B8B840]">
                        <img src="{{ asset('app/assets/images/icons/cup-green-fill.svg') }}" alt="icon"
                            class="size-[50px] shrink-0" />
                        <div>
                            <h3 class="font-bold text-[18px] leading-[27px]">Pro Talent</h3>
                            <p class="text-obito-text-secondary">3 months duration</p>
                        </div>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('app/assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Access 1500+ Online Courses</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('app/assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Get Premium Certifications</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('app/assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">High Quality Work Portfolio</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('app/assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Career Consultation 2025</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('app/assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon"
                            class="size-6 shrink-0" />
                        <p class="font-semibold">Support learning 24/7</p>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="js/dropdown-navbar.js"></script>
@endsection
