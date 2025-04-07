<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Edit\ChangePasswordRequest;
use App\Http\Requests\User\Edit\EditUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(EditUserRequest $request, $id)
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

        return redirect()->back()
            ->with('message', 'Data updated successfully')
            ->with('type', 'success');
    }

    public function changePassword(ChangePasswordRequest $request, $id)
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
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()
            ->with('message', 'Password changed successfully')
            ->with('type', 'success');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()
                ->with('message', 'User not found')
                ->with('type', 'error');
        }

        $user->delete();

        return redirect()->route('login')
            ->with('message', 'Account deleted successfully')
            ->with('type', 'success')
            ->header('X-Inertia-Location', route('login'));
    }
}
