<?php

namespace App\Providers;

use App\Models\VerificationCode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('person_name', function ($attribute, $value, $parameters, $validator) {
            return ctype_alpha(str_replace(' ', '', $value));
        }, ':attribute contains invalid characters.');

        Validator::extend('active_code', function ($attribute, $value, $parameters, $validator) {
            $email = $validator->getData()[$parameters[0]];

            return VerificationCode::query()
                ->where('code', $value)
                ->where('email', $email)
                ->where('status', 'unused')
                ->where('created_at', '<=', now())
                ->where('expires_at', '>=', now())
                ->exists();
        }, 'The :attribute has already expired or doesn\'t exist.');

        Validator::extend('custom_password', function ($attribute, $value, $parameters, $validator) {
            return preg_match_all('/[a-zA-Z0-9~`!@#\$%^&*()_\-+={[}\]|\\:;"\'<,>.?\/]/', $value) === strlen($value);
        }, 'The :attribute contains invalid characters.');
    }
}
