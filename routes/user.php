<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/Dashboard/Index');
})->name('dashboard')->middleware('auth:web');

Route::post('/user/{id}/edit/', [App\Http\Controllers\User\UserController::class, 'edit'])->name('user.edit')->middleware('auth:web');

Route::post('/user/{id}/changePassword', [App\Http\Controllers\User\UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth:web');
