<?php

namespace App\Providers;

use App\Tag;
use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['sidebar._categories'], function ($view) {
            $categories = Category::withCount('posts')->whereHas('posts')->orderBy('posts_count', 'DESC')->get();

            return $view->with('categories', $categories);
        });

        View::composer(['sidebar._tags'], function ($view) {
            $tags = Tag::withCount('posts')->whereHas('posts')->get();

            return $view->with('tags', $tags);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
