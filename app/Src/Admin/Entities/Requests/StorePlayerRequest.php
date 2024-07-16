<?php

namespace App\Src\Admin\Entities\Requests;

use App\Domains\Entities\Enums\PlayerGenderEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlayerRequest extends FormRequest
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
            'available' => ['nullable', 'numeric', 'min:0'],
            'coach_id' => ['nullable', 'integer', Rule::exists('coaches', 'id')],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('players', 'email')],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string'],
            'active' => ['required', 'boolean'],
            'avatar' => [
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
            'gender' => ['required', 'string', new EnumValue(PlayerGenderEnum::class)],
        ];
    }
}
