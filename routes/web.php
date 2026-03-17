<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lyrics/{id}', [SongController::class, 'show'])->name('song.show');
Route::get('/search', [SongController::class, 'search'])->name('song.search');
Route::get('/artist/{id}', [ArtistController::class, 'show'])->name('artist.show');

Route::get('/login', function () {
    return Inertia\Inertia::render('Login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', function () {
    return Inertia\Inertia::render('Register');
})->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/add', [DashboardController::class, 'create'])->name('song.create');
    Route::get('/dashboard/edit/{song}', [DashboardController::class, 'edit'])->name('song.edit');
    
    Route::post('/songs', [SongController::class, 'store'])->name('song.store');
    Route::put('/songs/{song}', [SongController::class, 'update'])->name('song.update');
    Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('song.destroy');
});
