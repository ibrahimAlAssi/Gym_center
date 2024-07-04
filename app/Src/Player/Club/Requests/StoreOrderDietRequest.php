<?php

namespace App\Src\Player\Club\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDietRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'weight' => ['required', 'integer', 'min:40', 'max:200'],
            'length' => ['required', 'integer', 'min:100', 'max:250'],
        ];
    }
}
