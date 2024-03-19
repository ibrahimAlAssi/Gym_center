<?php

namespace App\Src\Player\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreCoachRequest extends FormRequest
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
            'role_id'  => ['required', Rule::exists('roles', 'id')],
            'gym_id'   => ['required', Rule::exists('gyms', 'id')],
            'name'     => ['required', 'string'],
            'email'    => ['required', 'string', 'unique:admins,email'],
            'password' => ['required', 'string', Password::min(8)],
            'phone'    => ['required', 'string', 'unique:admins,phone'],
            'image'    => [
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000), // Maximum dimensions in pixels
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
