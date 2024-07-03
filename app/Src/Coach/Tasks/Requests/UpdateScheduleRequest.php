<?php

namespace App\Src\Coach\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateScheduleRequest extends FormRequest
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
            'player_id' => ['sometimes', Rule::exists('players', 'id')],
            'day'       => ['sometimes', 'min:1', 'max:7'],

            'schedule_tasks'           => ['sometimes', 'array', 'min:1'],
            'schedule_tasks.*.task_id' => ['sometimes', 'integer'],
            'schedule_tasks.*.repeat'  => ['sometimes', 'integer', 'min:1'],
            'schedule_tasks.*.weight'  => ['sometimes', 'integer', 'min:1'],

            'task_ids'   => ['sometimes', 'array', Rule::exists('tasks', 'id')],
            'task_ids.*' => ['integer', 'distinct'],
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
