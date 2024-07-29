<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . env('RECAPTCHA_SECRET_KEY') . "&response=" . $value);
            $responseKeys = json_decode($response, true);
            return $responseKeys['success'];
        });
    }
}
