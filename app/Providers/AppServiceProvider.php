<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
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
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID');

        View::share('upcoming', \App\Models\Event::where('start', '<=', Carbon::now()->subHours(1)->toDateTimeString())
            ->where('end', '>=', Carbon::now())
            ->orderBy('start', 'ASC')
            ->get());
    }
}
