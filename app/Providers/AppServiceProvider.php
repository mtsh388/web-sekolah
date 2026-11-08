<?php

namespace App\Providers;

use App\Models\MasterSekolah;
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
        View::composer('admin.*', function ($view) {
            $view->with(['user'=> Auth::user(),'master_sekolah'=>MasterSekolah::first()]);
        });
        View::composer('*', function ($view) {
            $view->with('master_sekolah', MasterSekolah::first());
        });
    }
}
