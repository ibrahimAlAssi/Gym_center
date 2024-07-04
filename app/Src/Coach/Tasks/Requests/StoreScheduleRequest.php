<?php

namespace App\Src\Coach\Tasks\Requests;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use App\Domains\Tasks\Enums\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'player_id' => ['required', Rule::exists('players', 'id')->where('players.coach_id', request()->user()->id)],
            'day'       => ['required', 'min:1', 'max:7'],

            'schedule_tasks'           => ['required', 'array', 'min:1'],
            'schedule_tasks.*.task_id' => ['required', 'integer'],
            'schedule_tasks.*.repeat'  => ['required', 'integer', 'min:1'],
            'schedule_tasks.*.weight'  => ['required', 'integer', 'min:1'],

            'task_ids'   => ['sometimes', 'array', Rule::exists('tasks', 'id')],
            'task_ids.*' => ['integer', 'distinct'],

        ];
    }

    public function prepareForValidation()
    {
        if ($this->filled('stores') && is_array($this->get('schedule_tasks'))) {
            $this->merge([
                'task_ids' => array_column($this->get('schedule_tasks'), 'task_id'),
            ]);
        }
    }
}
