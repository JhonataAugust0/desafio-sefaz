<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', action: [EmployeeController::class, 'index'])->name('dashboard');
    Route::get('/employee', [EmployeeController::class, 'get'])->name('employee.get');
    Route::patch('/employee', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
});

require __DIR__.'/auth.php';
