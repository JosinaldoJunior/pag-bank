<?php

namespace App\Providers;

use App\Repositories\Merchant\IMerchantRepository;
use App\Repositories\Merchant\MerchantRepository;
use App\Repositories\Payment\IPaymentRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Services\Merchant\IMerchantService;
use App\Services\Merchant\MerchantService;
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
        $this->app->bind(IMerchantService::class, MerchantService::class);
        $this->app->bind(IMerchantRepository::class, MerchantRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
