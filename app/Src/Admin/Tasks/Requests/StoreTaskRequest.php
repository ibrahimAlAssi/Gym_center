<?php

namespace App\Src\Admin\Tasks\Requests;

use App\Domains\Tasks\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            // 'type' => ['required', 'string', new Enum(TaskTypeEnum::class)],
            'type' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image'],
        ];
    }
}
