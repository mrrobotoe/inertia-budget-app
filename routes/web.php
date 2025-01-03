<?php

use App\Http\Controllers\Api\V1\BudgetController;
use App\Http\Controllers\ProfileController;
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

Route::get('/about', function () {
    return Inertia::render('About', [
        'user' => Auth()->user()
    ]);
})->middleware('auth:sanctum');

//Route::inertia('/about', 'About');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'token' => session('data')
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/budgets', [BudgetController::class, 'index'])->middleware('auth:sanctum')->name('budgets');
Route::get('/budgets/{budget}', [BudgetController::class, 'show'])->middleware('auth:sanctum')->name('budgets.show');
Route::get('/budgets/{budget}/reflect', [BudgetController::class, 'reflect'])->middleware('auth:sanctum')->name('budgets.reflect');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
