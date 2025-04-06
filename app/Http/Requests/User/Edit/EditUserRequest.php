<?php

namespace App\Http\Requests\User\Edit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'description' => ['sometimes', 'nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}