<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'role_ids' => 'required|array|min:1',

        ];
    }


    public function messages(): array
    {
        return[
            'name.required' => 'This field is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name may not be greater than 20 characters',
            'email.required' => 'This field is required',
            'email.string' => 'The email must be a string',
            'email.email' => 'The email must be a valid email address',
            'email.max' => 'The email may not be greater than 255 characters',
            'email.unique' => 'The email has already been taken',
            'role_ids.required' => 'This field is required',
            'role_ids.min' => 'You have to choose at least one role',
            'role_ids.array' => 'The roles must be an array',

        ];
    }
}
