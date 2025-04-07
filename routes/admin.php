<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard/Index');
})->name('admin.dashboard')->middleware('auth:web');
