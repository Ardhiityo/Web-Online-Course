<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\CourseSectionInterface;
use App\Services\Interfaces\SectionContentInterface;
use App\Services\Repositories\CourseSectionRepository;
use App\Services\Repositories\SectionContentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CourseSectionInterface::class, CourseSectionRepository::class);
        $this->app->singleton(SectionContentInterface::class, SectionContentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
