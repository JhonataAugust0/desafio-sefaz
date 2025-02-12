<?php

namespace App\Providers;

use App\Domains\Employee\Interfaces\IEmployeeRepository;
use App\Domains\Employee\Interfaces\IEmployeeService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Domains\Employee\Repositories\EmployeeRepository;
use App\Domains\Employee\Services\EmployeeService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);

        $this->app->bind(IEmployeeService::class, EmployeeService::class);
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
