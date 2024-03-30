<?php

namespace App\Src\Player\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeedbackRequest extends FormRequest
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
            'gym_id'       => ['required', 'numeric', Rule::exists('gyms', 'id')],
            'player_id'    => ['required', 'numeric', Rule::exists('players', 'id')],
            'message'      => ['required', 'string'],
            'is_complaint' => ['required', 'boolean'],
        ];
    }
}
