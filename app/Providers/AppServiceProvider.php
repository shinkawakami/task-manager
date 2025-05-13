<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

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
        //
    }
}
