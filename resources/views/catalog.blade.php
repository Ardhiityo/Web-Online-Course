@extends('layouts.app')

@section('content')
    <x-nav-menu />
    <main class="flex flex-col gap-10 pb-10 mt-[30px]">
        <section id="roadmap" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-4 mx-auto">
            <h2 class="font-bold text-[22px] leading-[33px]">Popular Course</h2>
            <div class="grid grid-cols-2 gap-5">
                @forelse ($popularCourses as $course)
                    <a href="{{ route('course-details', ['slug' => $course->slug]) }}" class="card">
                        <div
                            class="roadmap-card flex items-center rounded-[20px] border border-obito-grey p-[10px] pr-4 gap-4 bg-white hover:border-obito-green transition-all duration-300">
                            <div
                                class="relative flex shrink-0 w-[240px] h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="object-cover w-full h-full"
                                    alt="thumbnail">
                                <p
                                    class="absolute flex m-[10px] bottom-0 w-[calc(100%-20px)] items-center gap-0.5 bg-white rounded-[14px] py-[6px] px-2">
                                    <img src="{{ asset('app/assets/images/icons/cup.svg') }}" class="flex w-5 shrink-0"
                                        alt="icon">
                                    <span class="font-semibold text-xs leading-[18px]">Featured In AI Industry
                                        Digital</span>
                                </p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-lg font-bold line-clamp-2">{{ $course->name }}
                                </h3>
                                <p class="flex items-center gap-[6px]">
                                    <img src="{{ asset('app/assets/images/icons/menu-board-green.svg') }}"
                                        class="flex w-5 shrink-0" alt="icon">
                                    <span class="text-sm text-obito-text-secondary">{{ $course->total_course_section }}
                                        Chapter from
                                        {{ $course->total_section_content }}
                                        Lessons
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <a href="#" class="card">
                        <div
                            class="roadmap-card flex items-center rounded-[20px] border border-obito-grey p-[10px] pr-4 gap-4 bg-white hover:border-obito-green transition-all duration-300">
                            <div
                                class="relative flex shrink-0 w-[240px] h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="{{ asset('app/assets/images/thumbnails/thumbnail-1.png') }}"
                                    class="object-cover w-full h-full" alt="thumbnail">
                                <p
                                    class="absolute flex m-[10px] bottom-0 w-[calc(100%-20px)] items-center gap-0.5 bg-white rounded-[14px] py-[6px] px-2">
                                    <img src="{{ asset('app/assets/images/icons/cup.svg') }}" class="flex w-5 shrink-0"
                                        alt="icon">
                                    <span class="font-semibold text-xs leading-[18px]">Featured In AI Industry
                                        Digital</span>
                                </p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-lg font-bold line-clamp-2">Full-Stack Sr. Website JavaScript Developer 2025
                                </h3>
                                <p class="flex items-center gap-[6px]">
                                    <img src="{{ asset('app/assets/images/icons/briefcase-green.svg') }}"
                                        class="flex w-5 shrink-0" alt="icon">
                                    <span class="text-sm text-obito-text-secondary">Rp 125.500.000/year</span>
                                </p>
                                <p class="flex items-center gap-[6px]">
                                    <img src="{{ asset('app/assets/images/icons/menu-board-green.svg') }}"
                                        class="flex w-5 shrink-0" alt="icon">
                                    <span class="text-sm text-obito-text-secondary">18,498 Courses</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforelse
            </div>
        </section>
        <section id="catalog" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-4 mx-auto">
            <h1 class="font-bold text-[22px] leading-[33px]">Course Catalog</h1>
            <div id="tabs-container" class="flex gap-3 items-center">
                @foreach ($categories as $category)
                    <a href="{{ route('course', ['catalog' => $category->slug]) }}"
                        class="tab-btn group {{ $category->slug == request('catalog') ? 'active' : '' }}"
                        data-target="{{ $category->slug }}">
                        <p
                            class="rounded-full border border-obito-grey py-2 px-4 hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-black">
                            <span
                                class="group-[.active]:font-semibold group-[.active]:text-white">{{ ucfirst($category->name) }}</span>
                        </p>
                    </a>
                @endforeach
            </div>
            <div id="tabs-content-container" class="mt-1">
                @foreach ($courses as $course)
                    <div id="{{ $course->category->slug }}" class="grid grid-cols-4 gap-5 tab-content">
                        <a href="{{ route('course-details', $course->slug) }}" class="card">
                            <div
                                class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                                <div class="thumbnail-container p-[10px]">
                                    <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                            class="object-cover w-full h-full" alt="thumbnail">
                                        <p
                                            class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                            <img src="{{ asset('app/assets/images/icons/like.svg') }}" class="w-5 h-5"
                                                alt="icon">
                                            <span class="text-xs font-semibold">4.8</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col p-4 pt-0 gap-[13px]">
                                    <h3 class="text-lg font-bold line-clamp-2">{{ $course->name }}</h3>
                                    <p class="flex items-center gap-[6px]">
                                        <img src="{{ asset('app/assets/images/icons/crown-green.svg') }}"
                                            class="flex w-5 shrink-0" alt="icon">
                                        <span
                                            class="text-sm text-obito-text-secondary">{{ $course->category->name }}</span>
                                    </p>
                                    <p class="flex items-center gap-[6px]">
                                        <img src="{{ asset('app/assets/images/icons/menu-board-green.svg') }}"
                                            class="flex w-5 shrink-0" alt="icon">
                                        <span class="text-sm text-obito-text-secondary">{{ $course->total_course_section }}
                                            Chapter from {{ $course->total_section_content }}
                                            Lessons</span>
                                    </p>
                                    <p class="flex items-center gap-[6px]">
                                        <img src="{{ asset('app/assets/images/icons/briefcase-green.svg') }}"
                                            class="flex w-5 shrink-0" alt="icon">
                                        <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('app/js/dropdown-navbar.js') }}"></script>
    <script src="{{ asset('app/js/tabs.js') }}"></script>
@endsection
