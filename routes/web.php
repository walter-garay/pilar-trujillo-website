<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PublicationController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Publicaciones
Route::get('/publicaciones', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publicaciones/{publication}', [PublicationController::class, 'show'])->name('publications.show');

// Medias
Route::get('/multimedia/{type}/{media?}', [MediaController::class, 'show'])->name('multimedia.show');
Route::post('/media/{media}/like', [MediaController::class, 'like'])->name('media.like');
Route::delete('/media/{media}/like', [MediaController::class, 'unlike'])->name('media.unlike');
Route::post('/media/{media}/view', [MediaController::class, 'addView'])->name('media.addView');

Route::middleware(['auth', 'verified'])->group(function () {
    // Sponsors admin
    Route::get('/admin/auspiciadores', [SponsorController::class, 'adminIndex'])->name('admin.sponsors');
    Route::post('/admin/auspiciadores', [SponsorController::class, 'store'])->name('admin.sponsors.store');
    Route::post('/admin/auspiciadores/{sponsor}', [SponsorController::class, 'update'])->name('admin.sponsors.update');
    Route::delete('/admin/auspiciadores/{sponsor}', [SponsorController::class, 'destroy'])->name('admin.sponsors.destroy');

    // Publications admin
    Route::get('/admin/publicaciones', [PublicationController::class, 'adminIndex'])->name('admin.publications');
    Route::post('/admin/publicaciones', [PublicationController::class, 'store'])->name('admin.publications.store');
    Route::put('/admin/publicaciones/{publication}', [PublicationController::class, 'update'])->name('admin.publications.update');
    Route::delete('/admin/publicaciones/{publication}', [PublicationController::class, 'destroy'])->name('admin.publications.destroy');

    // Medias admin
    Route::get('/admin/multimedia', [MediaController::class, 'adminIndex']);
    Route::get('/admin/multimedia/{type}', [MediaController::class, 'adminIndex'])->name('admin.medias');
    Route::post('/admin/multimedia', [MediaController::class, 'store'])->name('admin.medias.store');
    Route::put('/admin/multimedia/{media}', [MediaController::class, 'update'])->name('admin.medias.update');
    Route::delete('/admin/multimedia/{media}', [MediaController::class, 'destroy'])->name('admin.medias.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
