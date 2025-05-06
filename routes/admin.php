<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Admin/Dashboard/Index');
    })->name('admin.dashboard');

    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('admin.users');

    Route::get('admin/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('admin/users/{id}/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('admin/users/{id}/delete', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
        ->name('admin.users.delete');
});