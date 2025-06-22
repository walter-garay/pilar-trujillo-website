<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::post('/contacto', [LandingPageController::class, 'contact'])->name('contact');

Route::get('/multimedia', [MediaController::class, 'index'])->name('multimedia.catalog');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
