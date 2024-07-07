<?php

namespace App\Src\Player\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskStatusRequest extends FormRequest
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
            'schedule_id' => ['required', 'integer', Rule::exists('schedules', 'id')],
            'task_id'     => ['required', 'integer', Rule::exists('tasks', 'id')],
        ];
    }
}