<?php

namespace App\Src\Admin\Club\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFoodRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:food,name',
            'nutritionalValues'   => ['sometimes', 'array', 'min:1'],
            'nutritionalValues.*.name'   => ['sometimes', 'string'],
            'nutritionalValues.*.value'   => ['sometimes', 'numeric'],
            'image' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
        ];
    }
}
