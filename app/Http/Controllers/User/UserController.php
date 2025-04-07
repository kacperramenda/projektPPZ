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
            return redirect()->back()
                ->with('message', 'User not found')
                ->with('type', 'error');
        }

        $user->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('dashboard')
            ->with('message', 'User updated successfully')
            ->with('type', 'success');
    }

    public function changePassword($id, ChangePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()
                ->with('message', 'User not found')
                ->with('type', 'error');
        }

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()
                ->with('message', 'Current password is incorrect')
                ->with('type', 'error');
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('dashboard')
            ->with('message', 'Password changed successfully')
            ->with('type', 'success');
    }

    public function delete($id): RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()
                ->with('message', 'User not found')
                ->with('type', 'error');
        }

        $user->delete();

        return redirect('/login')
            ->with('message', 'Account deleted successfully!')
            ->with('type', 'success');
    }
}
