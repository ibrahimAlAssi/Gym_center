<?php

namespace App\Src\Player\Entities\Requests;

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
            'email' => ['sometimes', 'string', 'unique:admins,email,'.$this->route('admin')->id],
            'phone' => ['sometimes', 'string', 'unique:admins,phone,'.$this->route('admin')->id],
            'description' => ['nullable', 'string'],
        ];
    }
}
