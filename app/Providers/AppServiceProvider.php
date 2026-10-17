<?php

namespace App\Providers;

use App\Models\cart_item;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // The client layout needs the cart summary on every page, including
        // pages whose route does not pass it explicitly (wishlist, single product...).
        View::composer('client.layouts.app', function ($view) {
            $data = $view->getData();

            if (!isset($data['number'])) {
                $view->with('number', cart_item::all());
            }

            if (!isset($data['carts'])) {
                $view->with('carts', cart_item::latest()->take(2)->get());
            }
        });
    }
}
