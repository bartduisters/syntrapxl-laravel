<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\Facades\Route;
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
        /*
        * Explicit Route Model Binding
        * Dit is nodig om te zorgen dat /opleidingen/1 werkt zoals /courses/1 zou werken.
        */
        Route::model('opleidingen', Course::class);
    }
}
