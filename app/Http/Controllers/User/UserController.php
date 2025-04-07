<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit($id)
    {
        // Logic to edit user
    }

    public function changePassword($id)
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
                ->with('message', 'User not found')
                ->with('type', 'error');
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('dashboard')
            ->with('message', 'Password changed successfully')
            ->with('type', 'success');
    }

    public function delete()
    {
        // Logic to delete user
    }
}
