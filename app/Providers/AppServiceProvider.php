<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('update-product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        Gate::define('order-details', function (User $user, Order $order) {
            return $user->id === $order->user_id;
        });
    }
}
