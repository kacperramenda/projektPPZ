<?php

namespace App\Http\Requests\User\Edit;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request to handle password change for a user.
 *
 * @group User Management
 *
 * This request validates the input for changing a user's password.
 */
class ChangePasswordRequest extends FormRequest
{
    /**
     * Define the validation rules for the change password request.
     *
     * @group User Management
     *
     * @bodyParam current_password string required The user's current password. Example: oldpassword123
     * @bodyParam password string required The new password. Must be at least 8 characters long and match the confirmation field. Example: newpassword123
     * @bodyParam password_confirmation string required The password confirmation. Example: newpassword123
     *
     * @response 422 {"message": "Validation error", "errors": {"current_password": ["The current password field is required."], "password": ["The password must be at least 8 characters."]}}
     *
     * @return array The array of validation rules.
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'], // The current password is required and must be a string.
            'password' => ['required', 'string', 'confirmed', 'min:8'], // The new password is required, must match the confirmation field, must be a string, and must be at least 8 characters long.
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @group User Management
     *
     * @response 403 {"message": "Unauthorized"}
     *
     * @return bool True if the user is authorized, false otherwise.
     */
    public function authorize(): bool
    {
        return true; // Always authorize the request.
    }
}