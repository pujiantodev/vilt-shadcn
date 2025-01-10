<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
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

// User
Route::prefix('/users')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
});

require __DIR__ . '/auth.php';
