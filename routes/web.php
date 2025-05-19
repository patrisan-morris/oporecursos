<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController;
use App\Models\Resource;
use App\Models\Topic;
use App\Models\User;

Route::get('/', function () {
    return Inertia::render('GuestLanding', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'topicsCount' => Topic::count(),
        'resourcesCount' => Resource::count(),
        'usersCount' => User::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('topics', TopicController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('resources', ResourceController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
});
require __DIR__.'/auth.php';
