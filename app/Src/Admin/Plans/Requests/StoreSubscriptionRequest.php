<?php

namespace App\Src\Admin\Plans\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubscriptionRequest extends FormRequest
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
            'player_id' => ['required', 'integer', Rule::exists('players', 'id')],
            'plan_id' => ['required', 'integer'],
            'coach_id' => ['nullable', 'integer', Rule::exists('coaches', 'id')],
            'description' => ['nullable', 'string'],
            'end_date' => ['required', 'date'],
        ];
    }
}
