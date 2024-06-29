<?php

namespace App\Src\Admin\Club\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDietRequest extends FormRequest
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
            'name' => ['sometimes', 'string', Rule::unique('diets', 'name')->ignore($this->diet->id)],
            'is_free' => ['sometimes', 'boolean'],
            'foods' => ['sometimes', 'array', 'min:1'],
            'foods.*.id' => ['sometimes', 'integer'],
            'foods.*.allowed_food' => ['sometimes', 'boolean'],
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
