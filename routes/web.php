<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/Dashboard/Index');
})->name('dashboard')->middleware('auth:web');

require __DIR__ . '/auth.php';

