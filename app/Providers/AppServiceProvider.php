<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Http\Hash\Block\BlockInterface::class,
            \App\Http\Hash\Block\Checker::class
        );
        $this->app->bind(
            \App\Http\Hash\Difference\DifferenceInterface::class,
            \App\Http\Hash\Difference\Checker::class
        );
        $this->app->bind(
            \App\Http\Hash\Perceptual\PerceptualInterface::class,
            \App\Http\Hash\Perceptual\Checker::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
