<?php

namespace App\Http\Requests\User\Edit;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}