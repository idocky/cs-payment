<?php

namespace App\Providers;

use App\Payment\Validation\PaygateAValidation;
use App\Payment\Validation\PaygateBValidation;
use App\Payment\Validation\PaymentValidationFactory;
use App\Services\PaymentProviders\Clients\PayGateAClientInterface;
use App\Services\PaymentProviders\Clients\PayGateAClientMock;
use App\Services\PaymentProviders\Clients\PayGateBClientInterface;
use App\Services\PaymentProviders\Clients\PayGateBClientMock;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PayGateAClientInterface::class, PayGateAClientMock::class);

        $this->app->bind(PayGateBClientInterface::class, PayGateBClientMock::class);

        $this->app->tag([
            PaygateAValidation::class,
            PaygateBValidation::class,
        ], 'payment.validation.strategies');

        $this->app->singleton(PaymentValidationFactory::class, function ($app) {
            return new PaymentValidationFactory(
                $app->tagged('payment.validation.strategies'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
