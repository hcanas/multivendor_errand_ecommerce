<?php

namespace App\Providers;

use App\Models\VerificationCode;
use App\Observers\VerificationCodeObserver;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerificationCode::observe(VerificationCodeObserver::class);
    }
}
