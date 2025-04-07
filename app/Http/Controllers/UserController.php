<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'description' => 'nullable'
        ]);

        User::create($validated);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        if (!auth()->user()->can('edit users')) {
            abort(403);
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->can('edit users')) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'description' => 'nullable'
        ]);

        $user->update($validated);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete users')) {
            abort(403);
        }
        
        $user->delete();
        return redirect()->route('users.index');
    }
}
