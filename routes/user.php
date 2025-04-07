<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/Dashboard/Index');
})->name('dashboard')->middleware('auth:web');

Route::post('/user/{id}/edit/', [App\Http\Controllers\User\UserController::class, 'update'])->name('user.update')->middleware('auth:web');

Route::post('/user/{id}/changePassword', [App\Http\Controllers\User\UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth:web');

Route::delete('/user/{id}/delete', [App\Http\Controllers\User\UserController::class, 'delete'])->name('user.delete')->middleware('auth:web');