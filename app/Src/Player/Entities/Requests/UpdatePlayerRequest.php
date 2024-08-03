<?php

namespace App\Src\Player\Entities\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlayerRequest extends FormRequest
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
            'name' => ['sometimes', 'string', ''],
            'email' => ['sometimes', 'email', Rule::unique('players', 'email')
                ->ignore(request()->user()->id)],
            'phone' => ['sometimes', 'string', Rule::unique('players', 'phone')
                ->ignore(request()->user()->id), 'min_digits:10'],
            'avatar' => [
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
            'birth_day' => ['sometimes', 'date', 'date_format:Y-m-d'],
        ];
    }
}
