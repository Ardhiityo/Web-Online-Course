<a href="{{ route('course-details', $course->slug) }}" class="card">
    <div
        class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
        <div class="thumbnail-container p-[10px]">
            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="object-cover w-full h-full" alt="thumbnail">
                <p
                    class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                    <img src="{{ asset('app/assets/images/icons/like.svg') }}" class="w-5 h-5" alt="icon">
                    <span class="text-xs font-semibold">4.8</span>
                </p>
            </div>
        </div>
        <div class="flex flex-col p-4 pt-0 gap-[13px]">
            <h3 class="text-lg font-bold line-clamp-2">{{ $course->name }}</h3>
            <p class="flex items-center gap-[6px]">
                <img src="{{ asset('app/assets/images/icons/crown-green.svg') }}" class="flex w-5 shrink-0"
                    alt="icon">
                <span class="text-sm text-obito-text-secondary">{{ $course->category->name }}</span>
            </p>
            <p class="flex items-center gap-[6px]">
                <img src="{{ asset('app/assets/images/icons/menu-board-green.svg') }}" class="flex w-5 shrink-0"
                    alt="icon">
                <span class="text-sm text-obito-text-secondary">{{ $course->total_course_section }}
                    Chapter from {{ $course->total_section_content }}
                    Lessons</span>
            </p>
            <p class="flex items-center gap-[6px]">
                <img src="{{ asset('app/assets/images/icons/briefcase-green.svg') }}" class="flex w-5 shrink-0"
                    alt="icon">
                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
            </p>
        </div>
    </div>
</a>
