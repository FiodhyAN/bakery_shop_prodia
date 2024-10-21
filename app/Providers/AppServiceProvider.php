<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
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
        // if (Auth::check()) {
        view()->composer(
            'layouts.app',
            function ($view) {
                if (Auth::check()) {
                    $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
                    $view->with(['carts' => $carts, 'total' => 'Rp. ' . number_format($carts->sum('price'), 0, ',', '.')]);
                } else {
                    $carts = [];
                    $view->with('carts', $carts);
                }
            }
        );
        // }
    }
}
