<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
             View::composer('*', function($view){
            $view->with('globalSiteSettings', Setting::first());
            $view->with('globalCarts', Cart::where('ip_address', request()->ip())->with('product')->get());
            $view->with('globalCartCount', Cart::where('ip_address', request()->ip())->count());
            $view->with('globalCategories', Category::orderBy('name', 'asc')->with('subCategory')->get());
            $view->with('globalSubCategories', SubCategory::orderBy('name', 'asc')->get());
        });
    }
}
