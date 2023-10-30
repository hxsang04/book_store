<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer(['frontend.layout.master','frontend.shop'], function (View $view) {
            $categories = Category::all();
            $publishers = Publisher::all();
            $authors = Author::limit(8)->get();

            $view->with(compact('categories','publishers','authors'));
        });
    }
}
