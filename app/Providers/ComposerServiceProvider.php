<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Tag;
use App\Post;
use App\Comment;
use Carbon\Carbon;

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

        view()->composer(['partials.popular'], function($view) {
            $view->with('popular_posts', Post::where('status', '=', 'publish')
                ->where('created_at', '>=', Carbon::now()->subWeeks(1))
                ->orderBy('view_count', 'desc')->take(4)->get());

            $view->with('recent_posts', Post::where('status', '=', 'publish')->orderBy('id', 'desc')->take(4)->get());

            $view->with('recent_comments', Comment::where('is_active', '=', 1)->orderBy('id', 'desc')->take(7)->get());
        });

        view()->composer(['partials.popular-news'], function($view) {
            $view->with('most_comment_posts',
                    Post::leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                        ->groupBy('posts.id')
                        ->orderBy('comments_count','desc')
                        ->selectRaw('posts.*, count(comments.id) as comments_count')
                        ->where('posts.created_at', '>=', Carbon::now()->subWeeks(1))
                        ->take(3)
                        ->get()
            );
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
