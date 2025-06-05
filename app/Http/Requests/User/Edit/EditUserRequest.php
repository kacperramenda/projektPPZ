<?php

namespace App\Http\Requests\User\Edit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{
    /**
     * Define the validation rules for the edit user request.
     *
     * @return array The array of validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'], // The name field is required, must be a string, and cannot exceed 255 characters.
            'surname' => ['required', 'string', 'max:255'], // The surname field is required, must be a string, and cannot exceed 255 characters.
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id)
            ], // The email field is required, must be a valid email, unique in the users table (excluding the current user), and cannot exceed 255 characters.
            'description' => ['sometimes', 'nullable', 'string'], // The description field is optional, can be null, and must be a string if provided.
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool True if the user is authorized, false otherwise.
     */
    public function authorize(): bool
    {
        return true; // Always authorize the request.
    }
}