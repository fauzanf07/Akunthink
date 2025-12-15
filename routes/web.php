<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleSheetController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', [GoogleSheetController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/initialData', function () {
    return Inertia::render('InitialDataForm');
})->middleware(['auth', 'verified'])->name('initialData');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/initialData/save', [ProfileController::class, 'initialDataSave'])->name('profile.initialData.save');
});


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/google/copy-sheet', [GoogleSheetController::class, 'copySpreadsheet'])->name('google.copySpreadsheet');


Route::get('/blog', function () {
    return Inertia::render('Blog/Index');
})->name('blog.index');

Route::get('/blog/{id}', function ($id) {
    return Inertia::render('Blog/Show', [
        'id' => $id
    ]);
})->name('blog.show');


require __DIR__.'/auth.php';
