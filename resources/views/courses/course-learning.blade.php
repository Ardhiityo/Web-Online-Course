@extends('layouts.app')

@section('title', 'Course Learning - Obito Online Learning Platform')

@section('content')
    <div class="flex h-screen">
        <aside class="flex flex-col bg-white border border-obito-grey">
            <div class="w-[260px] pb-[20px] h-[280px] px-5 pt-5 flex flex-col gap-5">
                <ul>
                    <li>
                        <a href="{{ route('course.index') }}">
                            <div
                                class="flex items-center gap-2 py-[10px] px-[14px] rounded-full border border-obito-grey bg-white hover:border-obito-green transition-all duration-300">
                                <img src="{{ asset('app/assets/images/icons/home-trend-up.svg') }}" alt="icon"
                                    class="size-[20px] shrink-0" />
                                <p>Back to Dashboard</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <header class="flex flex-col gap-[12px]">
                    <div class="flex justify-center items-center overflow-hidden w-full h-[100px] rounded-[14px]">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                            class="object-cover w-full h-full" />
                    </div>
                    <h1 class="font-bold">{{ $course->name }}</h1>
                </header>
                <hr class="border-obito-grey" />
            </div>
            <div id="lessons-container" class="h-full overflow-y-auto [&::-webkit-scrollbar]:hidden w-[260px]">
                <nav class="px-5 pb-[33px] flex flex-col gap-5">
                    @foreach ($course->courseSections as $courseSection)
                        <div class="flex flex-col gap-4 lesson accordion">
                            <button type="button" data-expand="{{ Str::slug($courseSection->name) }}"
                                class="flex justify-between items-center">
                                <h2 class="font-semibold">{{ $courseSection->name }}</h2>
                                <img src="{{ asset('app/assets/images/icons/arrow-circle-down.svg') }}" alt="icon"
                                    class="transition-all duration-300 size-6 shrink-0" />
                            </button>
                            <div id="{{ Str::slug($courseSection->name) }}"
                                class="{{ request()->is("course/learning/$course->slug/$courseSection->id/*") ? 'block' : 'hidden' }}">
                                <ul class="flex flex-col gap-4">
                                    @foreach ($courseSection->sectionContents as $sectionContent)
                                        <li
                                            class="group {{ request()->is("course/learning/$course->slug/$courseSection->id/$sectionContent->id") ? 'active' : '' }}">
                                            <a
                                                href="{{ route('course.learning', [
                                                    'slug' => $course->slug,
                                                    'courseSection' => $courseSection->id,
                                                    'sectionContent' => $sectionContent->id,
                                                ]) }}">
                                                <div
                                                    class="px-4 group-[&.active]:bg-obito-black group-[&.active]:border-transparent group-[&.active]:text-white py-[10px] rounded-full border border-obito-grey group-hover:bg-obito-black transition-all duration-300">
                                                    <h3
                                                        class="font-semibold text-sm leading-[21px] group-hover:text-white transition-all duration-300">
                                                        {{ $sectionContent->name }}</h3>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr class="border-obito-grey" />
                    @endforeach
                </nav>
            </div>
        </aside>
        <div class="overflow-y-auto flex-grow">
            <main class="pt-[30px] pb-[118px] pl-[50px]">
                <article>
                    {!! $content->content !!}
                </article>
            </main>
            <nav class="fixed bottom-0 left-auto right-0 z-30 mx-auto w-[calc(100%-260px)] pt-5 pb-[30px] bg-[#F8FAF9]">
                <div class="px-[30px]">
                    <div
                        class="content border border-obito-grey rounded-[20px] bg-white p-[12px] flex items-center justify-between">
                        <p class="text-obito-text-secondary">Pelajari materi dengan baik, jika bingung maka tanya mentor
                            kelas</p>
                        <div class="buttons flex items-center gap-[12px]">
                            <a href="#"
                                class="rounded-full border border-obito-grey px-5 py-[10px] hover:border-obito-green transition-all duration-300">
                                <span class="font-semibold">Ask Mentor</span>
                            </a>
                            @if (session()->get('completed'))
                                <a href="{{ route('course.learning-finished', [
                                    'slug' => $course->slug,
                                ]) }}"
                                    class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                                    <span class="font-semibold">Completed</span>
                                </a>
                            @else
                                <a href="{{ route('course.learning', [
                                    'slug' => $course->slug,
                                    'courseSection' => $nextSection,
                                    'sectionContent' => $nextContent,
                                ]) }}"
                                    class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                                    <span class="font-semibold">Next Lesson</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/monokai-sublime.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('app/js/accordion.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>
    <!-- Tambahkan bahasa yang Anda butuhkan -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/go.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            hljs.highlightAll();
        });
    </script>
@endpush
