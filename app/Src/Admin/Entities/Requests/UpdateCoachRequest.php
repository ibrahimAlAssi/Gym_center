<?php

namespace App\Src\Admin\Entities\Requests;

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
            'specialization' => ['sometimes', 'string'],
            'experienceYears' => ['sometimes', 'numeric'],
            'subscribePrice' => ['sometimes', 'numeric'],
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'unique:coaches,email,'.$this->route('coach')->id],
            'phone' => ['sometimes', 'string', 'unique:coaches,phone,'.$this->route('coach')->id],
            'description' => ['nullable', 'string'],
        ];
    }
}
