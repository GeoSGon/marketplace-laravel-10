<?php

namespace App\Providers;

use App\Http\Views\CategoryViewComposer;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
      $categories = Category::all(['name', 'slug']);

//      view()->share('categories', $categories);

        view()->composer('layouts.front', function($view) use($categories){
            $view->with('categories', $categories);
        });

//        view()->composer('*', [CategoryViewComposer::class, 'compose']);
    }
}
