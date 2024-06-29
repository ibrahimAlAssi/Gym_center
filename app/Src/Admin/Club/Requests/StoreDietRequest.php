<?php

namespace App\Src\Admin\Club\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDietRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('diets', 'name')],
            'is_free' => ['required', 'boolean'],
            'foods' => ['required', 'array', 'min:1'],
            'foods.*.id' => ['required', 'integer'],
            'foods.*.allowed' => ['required', 'boolean'],
            'foods_ids' => ['sometimes', 'array', Rule::exists('foods', 'id')],
            'foods_ids.*' => ['integer', 'distinct'],
        ];
    }

    public function prepareForValidation()
    {
        if ($this->filled('stores') && is_array($this->get('foods'))) {
            $this->merge([
                'foods_ids' => array_column($this->get('foods'), 'id'),
            ]);
        }
    }
}
