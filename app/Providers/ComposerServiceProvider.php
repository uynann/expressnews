<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Tag;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials.header', 'partials.footer'], function($view) {
            $view->with('categories', Category::whereNotIn('id', [5])->get());
        });

        view()->composer(['partials.tag'], function($view) {
            $view->with('tags', Tag::all());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
