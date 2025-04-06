<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Edit\EditUserRequest;
use App\Http\Requests\User\Edit\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function edit($id, EditUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not found']);
        }

        $user->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }

    public function changePassword($id, ChangePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not found']);
        }

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['message' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('dashboard')->with('success', 'User password updated successfully');
    }

    public function delete($id): RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not found']);
        }

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully');    }
}
