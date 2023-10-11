<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeritController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/api/search-student', [MeritController::class, 'searchStudent']);
    Route::get('/api/save-points', [MeritController::class, 'savePoints']);
    Route::get('/api/remove-points', [MeritController::class, 'removePoints']);
    // In web.php
Route::get('/api/programs', [MeritController::class, 'getPrograms']);
Route::get('/api/retrieve-points', [MeritController::class, 'retrievePoints']);
});

// Add new routes for handling programs
Route::get('/api/programs', [ProgramController::class, 'index']); // Example route for fetching programs


require __DIR__.'/auth.php';
