<?php

namespace App\Src\Admin\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('tasks', 'name')],
            'type_id' => ['required', 'string', Rule::exists('types', 'id')],
            'number' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image'],
        ];
    }
}
