<?php

use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [StoryController::class, 'index'])->name('home');
    Route::get('/dashboard', [StoryController::class, 'index'])->name('dashboard');
    Route::get('/stories', [StoryController::class, 'index'])->name('stories');
    Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');
});
