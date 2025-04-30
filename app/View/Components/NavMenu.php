<?php

namespace App\View\Components;

use App\Services\CategoryService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class NavMenu extends Component
{
    public $slug;

    /**
     * Create a new component instance.
     */
    public function __construct(private CategoryService $categoryService)
    {
        $this->slug = Cache::remember('nav-menu', 3600, function () use ($categoryService) {
            return $categoryService->getFirstCategory()->slug;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-menu');
    }
}
