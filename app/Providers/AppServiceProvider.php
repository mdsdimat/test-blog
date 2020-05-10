<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Observers\Blog\CategoryObserver;
use App\Observers\Blog\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BlogPost::observe(PostObserver::class);
        BlogCategory::observe(CategoryObserver::class);
    }
}
