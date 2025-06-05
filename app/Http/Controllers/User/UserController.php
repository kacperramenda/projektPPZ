<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Edit\ChangePasswordRequest;
use App\Http\Requests\User\Edit\EditUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * Redirects admin users to the admin users page with an error message.
     * Otherwise, renders the user dashboard with the authenticated user's data.
     *
     * @group User Management
     * @response 200 {"user": {"id": 1, "name": "John", "surname": "Doe", "email": "john.doe@example.com"}}
     * @response 403 {"message": "You are not allowed to access this page"}
     *
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.users')
                ->with('message', 'You are not allowed to access this page')
                ->with('type', 'error');
        }
        return inertia('User/Index', [
            'user' => auth()->user(),
        ]);
    }


    /**
     * Update the specified user's information.
     *
     * Validates the request data and updates the user's name, surname, email, and description.
     * If the user is not found, redirects back with an error message.
     *
     * @group User Management
     * @urlParam id int required The ID of the user to update. Example: 1
     * @bodyParam name string required The user's first name. Example: John
     * @bodyParam surname string required The user's last name. Example: Doe
     * @bodyParam email string required The user's email address. Example: john.doe@example.com
     * @bodyParam description string optional The user's description. Example: Software Developer
     * @response 200 {"message": "Data updated successfully"}
     * @response 404 {"message": "User not found"}
     *
     * @param \App\Http\Requests\User\Edit\EditUserRequest $request The validated request data.
     * @param int $id The ID of the user to update.
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Change the specified user's password.
     *
     * Validates the request data, checks the current password, and updates the password.
     * If the user is not found or the current password is incorrect, redirects back with an error message.
     *
     * @group User Management
     * @urlParam id int required The ID of the user whose password is being changed. Example: 1
     * @bodyParam current_password string required The user's current password. Example: oldpassword123
     * @bodyParam password string required The new password. Example: newpassword123
     * @bodyParam password_confirmation string required The password confirmation. Example: newpassword123
     * @response 200 {"message": "Password changed successfully"}
     * @response 404 {"message": "User not found"}
     * @response 400 {"message": "Current password is incorrect"}
     *
     * @param \App\Http\Requests\User\Edit\ChangePasswordRequest $request The validated request data.
     * @param int $id The ID of the user whose password is being changed.
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Delete the specified user's account.
     *
     * Finds the user by ID and deletes their account.
     * If the user is not found, redirects back with an error message.
     * After deletion, redirects to the login page with a success message.
     *
     * @group User Management
     * @urlParam id int required The ID of the user to delete. Example: 1
     * @response 200 {"message": "Account deleted successfully"}
     * @response 404 {"message": "User not found"}
     *
     * @param int $id The ID of the user to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
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