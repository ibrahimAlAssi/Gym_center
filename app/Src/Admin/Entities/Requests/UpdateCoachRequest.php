<?php

namespace App\Src\Admin\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            'available' => ['sometimes', 'numeric', 'min:0'],
            'pending' => ['sometimes', 'numeric', 'min:0'],
            'specialization' => ['sometimes', 'string'],
            'experienceYears' => ['sometimes', 'numeric'],
            'subscribePrice' => ['sometimes', 'numeric'],
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'unique:coaches,email,'.$this->route('coach')->id],
            'phone' => ['sometimes', 'string', 'unique:coaches,phone,'.$this->route('coach')->id],
            'description' => ['nullable', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            if ($this->filled('available') && $this->filled('pending')) {
                throw ValidationException::withMessages([
                    'available' => 'pending:cannot_present_same_time',
                    'pending' => 'available:cannot_present_same_time',
                ]);
            }
        });
    }
}
