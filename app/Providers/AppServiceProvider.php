<?php

namespace App\Providers;

use App\Repositories\Payment\IPaymentRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Services\Payment\IPaymentService;
use App\Services\Payment\PaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IPaymentService::class, PaymentService::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
