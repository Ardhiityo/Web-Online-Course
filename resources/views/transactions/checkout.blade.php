@extends('layouts.app')

@section('content')
    <x-nav-profile />
    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5">
            <a href="{{ route('home') }}" class="last-of-type:font-semibold">Home</a>
            <div class="w-px h-10 bg-obito-grey"></div>
            <a href="{{ route('pricing') }}" class="last-of-type:font-semibold">Pricing Packages</a>
            <span class="text-obito-grey">/</span>
            <a href="{{ url()->current() }}" class="last-of-type:font-semibold">Checkout Subscription</a>
        </div>
    </div>
    <main class="flex flex-1 justify-center items-center py-5">
        <div class="flex w-[1000px] !h-fit rounded-[20px] border border-obito-grey gap-[40px] bg-white items-center p-5">
            <form id="checkout-details" class="flex flex-col gap-5 w-full">
                @csrf
                <h1 class="font-bold text-[22px] leading-[33px]">Checkout Pro</h1>
                <input type="hidden" name="pricing_id" value="{{ $pricing->id }}">
                <section id="give-access-to" class="flex flex-col gap-2">
                    <h2 class="font-semibold">Give Access to</h2>
                    <div class="flex items-center justify-between rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="profile flex items-center gap-[14px]">
                            <div class="flex justify-center items-center overflow-hidden size-[50px] rounded-full">
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="image"
                                    class="object-cover size-full" />
                            </div>
                            <div class="desc flex flex-col gap-[3px]">
                                <h3 class="font-semibold">{{ Auth::user()->name }}</h3>
                                <p class="text-sm leading-[21px] text-obito-text-secondary">{{ Auth::user()->occupation }}
                                </p>
                            </div>
                        </div>
                        <a href="#">
                            <p class="text-sm leading-[21px] hover:underline text-obito-green">Change Account</p>
                        </a>
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
                            <strong class="font-semibold">Rp
                                {{ number_format($pricing->price, thousands_separator: '.') }}</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Access Duration</p>
                            </div>
                            <strong class="font-semibold">{{ $pricing->duration }} Months</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Started At</p>
                            </div>
                            <strong class="font-semibold">{{ now()->format('d F Y') }}</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>Ended At</p>
                            </div>
                            <strong class="font-semibold">
                                {{ now()->addMonths($pricing->duration)->format('d F y') }}
                            </strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p>PPN 11%</p>
                            </div>
                            <strong class="font-semibold">Rp
                                {{ number_format($pricing->price * 0.11, thousands_separator: '.') }}
                            </strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2 items-center">
                                <img src="{{ asset('app/assets/images/icons/note.svg') }}" alt="icon"
                                    class="size-5 shrink-0" />
                                <p class="whitespace-nowrap">Grand Total</p>
                            </div>
                            <strong class="font-bold text-[22px] leading-[33px] text-obito-green">Rp
                                {{ number_format($pricing->price * 0.11 + $pricing->price, thousands_separator: '.') }}
                            </strong>
                        </div>
                    </div>
                </section>
                <div class="grid grid-cols-2 gap-[14px]">
                    <a href="{{ route('pricing') }}">
                        <div
                            class="flex border border-obito-grey rounded-full items-center justify-center py-[10px] hover:border-obito-green transition-all duration-300">
                            <p class="font-semibold">Cancel</p>
                        </div>
                    </a>
                    @if ($hasMembership)
                        <button type="submit" disabled
                            class="flex text-white bg-obito-grey rounded-full items-center justify-center py-[10px]">
                            <p class="font-semibold text-obito-text-grey">Membership ongoing</p>
                        </button>
                    @else
                        <button type="submit"
                            class="flex text-white bg-obito-green rounded-full items-center justify-center py-[10px] hover:drop-shadow-effect transition-all duration-300">
                            <p class="font-semibold">Pay Now</p>
                        </button>
                    @endif
                </div>
                <hr class="border-obito-grey" />
                <p class="text-sm leading-[21px] text-center hover:underline text-obito-text-secondary">Pahami Terms &
                    Conditions Platform Kami</p>
            </form>
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
                            <h3 class="font-bold text-[18px] leading-[27px]">{{ $pricing->name }}</h3>
                            <p class="text-obito-text-secondary">{{ $pricing->duration }} months duration</p>
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

@push('scripts')
    <script src="{{ asset('app/js/dropdown-navbar.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        function handlePayment(data) {
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.location.href = `/checkout/success/${result.order_id}`;
                },
                onPending: function(result) {
                    alert('Pembayaran pending');
                },
                onError: function(result) {
                    alert('Pembayaran gagal');
                }
            });
        }

        $form = document.getElementById('checkout-details');
        $form.addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                const response = await fetch('{{ route('checkout.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        pricing_id: '{{ $pricing->id }}',
                    })
                });

                const data = await response.json();
                handlePayment(data);
            } catch (error) {
                alert('Failed to checkout');
                console.log(error);
            }
        })
    </script>
@endpush
