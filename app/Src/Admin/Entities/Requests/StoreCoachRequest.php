<?php

namespace App\Src\Admin\Entities\Requests;

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
            'available' => ['nullable', 'numeric', 'min:0'],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'name' => ['required', 'string'],
            'specialization' => ['required', 'string'],
            'experienceYears' => ['required', 'numeric'],
            'subscribePrice' => ['required', 'numeric'],
            'email' => ['required', 'string', 'unique:coaches,email'],
            'password' => ['required', 'string', Password::min(8)],
            'phone' => ['required', 'string', 'unique:coaches,phone'],
            'avatar' => [
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
