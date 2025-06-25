<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SponsorController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::post('/contacto', [LandingPageController::class, 'contact'])->name('contact');

Route::get('/multimedia/{type}/{media?}', [MediaController::class, 'show'])->name('multimedia.show');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/media/{media}/like', [MediaController::class, 'like'])->name('media.like');
Route::delete('/media/{media}/like', [MediaController::class, 'unlike'])->name('media.unlike');
Route::post('/media/{media}/view', [MediaController::class, 'addView'])->name('media.addView');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/auspiciadores', [SponsorController::class, 'adminIndex'])->name('admin.sponsors');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
