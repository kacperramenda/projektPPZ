<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Home page', 200);
});

Route::get('/example', function () {
    return response('Example page', 200);
});
