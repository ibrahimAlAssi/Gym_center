<?php

namespace App\Src\Coach\Tasks\Requests;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Domains\Tasks\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

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
            'type' => ['required', 'string', new EnumValue(TaskTypeEnum::class)],
            'number' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image'],
        ];
    }
}
