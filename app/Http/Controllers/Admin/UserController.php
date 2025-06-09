<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // return inertia('Admin/Users/Index', [
        //     'users' => \App\Models\User::with('roles')->get(),
        // ]);

        $users = User::with('roles')->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|email',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'surname', 'email'));
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users')->with('success', 'Użytkownik zaktualizowany');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from deleting their own account
        if ($user->id === Auth::id()) {
            abort(403, 'You cannot delete your own account');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('message', 'User deleted successfully')
            ->with('type', 'success');
    }
}
