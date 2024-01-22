<?php

namespace App\Src\Admin\Club\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'location.latitude' => ['required', 'numeric'],
            'location.longitude' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
        ];
    }
}
