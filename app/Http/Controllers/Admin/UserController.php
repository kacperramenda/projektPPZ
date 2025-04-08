<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return inertia('Admin/Users/Index', [
            'users' => \App\Models\User::with('roles')->get(),
        ]);
    }
}
