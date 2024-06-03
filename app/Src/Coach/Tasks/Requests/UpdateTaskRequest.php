<?php

namespace App\Src\Coach\Tasks\Requests;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Domains\Tasks\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

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
            'type' => ['sometimes', 'string', new EnumValue(TaskTypeEnum::class)],
            'number' => ['sometimes', 'integer'],
            'description' => ['sometimes', 'string'],
            'image' => ['sometimes', 'image'],
        ];
    }
}
