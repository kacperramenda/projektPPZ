<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return Inertia::render('User/Dashboard/Index');
})->name('dashboard')->middleware('auth:web');

Route::put('/user/{id}/edit/', [App\Http\Controllers\User\UserController::class, 'edit'])->name('user.edit')->middleware('auth:web');
Route::put('/user/{id}/changePassword', [App\Http\Controllers\User\UserController::class, 'changePassword'])->name('user.changePassword')->middleware('auth:web');
Route::delete('/user/{id}', [App\Http\Controllers\User\UserController::class, 'delete'])->name('user.delete')->middleware('auth:web');
