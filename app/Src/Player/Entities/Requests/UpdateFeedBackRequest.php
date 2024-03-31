<?php

namespace App\Src\Player\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedBackRequest extends FormRequest
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
            'message' => ['sometimes', 'string'],
            'is_complaint' => ['sometimes', 'boolean'],
        ];
    }
}
