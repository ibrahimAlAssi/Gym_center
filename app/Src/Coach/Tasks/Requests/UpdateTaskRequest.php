<?php

namespace App\Src\Coach\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'name' => ['sometimes', 'string', Rule::unique('tasks', 'name')->ignore($this->task->id)],
            'type_id' => ['sometimes', 'string', Rule::exists('types', 'id')],
            'number' => ['sometimes', 'integer'],
            'description' => ['sometimes', 'string'],
            'url' => ['sometimes'],
            'image' => ['sometimes', 'image'],
        ];
    }
}
