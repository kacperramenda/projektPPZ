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
    /**
     * Display a listing of the users.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch all users with their associated roles
        $users = User::with('roles')->get();

        // Render the users index page with the fetched users
        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id The ID of the user to edit
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        // Find the user by ID with their associated roles
        $user = User::with('roles')->findOrFail($id);

        // Render the user edit page with the fetched user
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing user data
     * @param int $id The ID of the user to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|email',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->update($request->only('name', 'surname', 'email'));

        // Sync the user's roles
        $user->syncRoles($request->roles);

        // Redirect back to the users list with a success message
        return redirect()->route('admin.users')->with('success', 'Użytkownik zaktualizowany');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id The ID of the user to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Prevent the admin from deleting their own account
        if ($user->id === Auth::id()) {
            abort(403, 'You cannot delete your own account');
        }

        // Delete the user
        $user->delete();

        // Redirect back to the users list with a success message
        return redirect()
            ->route('admin.users')
            ->with('message', 'User deleted successfully')
            ->with('type', 'success');
    }
}
