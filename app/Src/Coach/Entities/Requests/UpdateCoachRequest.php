<?php

namespace App\Src\Coach\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCoachRequest extends FormRequest
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
            'role_id' => ['sometimes', Rule::exists('roles', 'id')],
            'gym_id' => ['sometimes', Rule::exists('gyms', 'id')],
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string',  Rule::unique('coaches', 'email')->ignore(auth()->id())],
            'phone' => ['sometimes', 'string', 'unique:coaches,phone,'.auth()->user('coach')->id],
            'description' => ['nullable', 'string'],
        ];
    }
}