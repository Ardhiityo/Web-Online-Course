<a href="{{ route('course.details', ['course' => $course->slug]) }}" class="card">
    <div
        class="roadmap-card flex items-center rounded-[20px] border border-obito-grey p-[10px] pr-4 gap-4 bg-white hover:border-obito-green transition-all duration-300">
        <div class="relative flex shrink-0 w-[240px] h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="object-cover w-full h-full" alt="thumbnail">
            <p
                class="absolute flex m-[10px] bottom-0 w-[calc(100%-20px)] items-center gap-0.5 bg-white rounded-[14px] py-[6px] px-2">
                <img src="{{ asset('app/assets/images/icons/cup.svg') }}" class="flex w-5 shrink-0" alt="icon">
                <span class="font-semibold text-xs leading-[18px]">Featured In AI Industry
                    Digital</span>
            </p>
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="text-lg font-bold line-clamp-2">{{ $course->name }}
            </h3>
            <p class="flex items-center gap-[6px]">
                <img src="{{ asset('app/assets/images/icons/menu-board-green.svg') }}" class="flex w-5 shrink-0"
                    alt="icon">
                <span class="text-sm text-obito-text-secondary">{{ $course->total_course_section }}
                    Chapter from
                    {{ $course->total_section_content }}
                    Lessons
                </span>
            </p>
        </div>
    </div>
</a>
