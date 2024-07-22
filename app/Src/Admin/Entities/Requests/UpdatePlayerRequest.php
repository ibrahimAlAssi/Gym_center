<?php

namespace App\Src\Admin\Entities\Requests;

use App\Domains\Entities\Enums\PlayerGenderEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            'available' => ['sometimes', 'numeric', 'min:0'],
            'pending' => ['sometimes', 'numeric', 'min:0'],
            'coach_id' => ['sometimes', 'integer', Rule::exists('coaches', 'id')],
            'name' => ['sometimes', 'string'],
            'email' => [
                'sometimes', 'email', Rule::unique('players', 'email')
                    ->ignore($this->player->id),
            ],
            'password' => ['sometimes', 'string', 'min:8'],
            'phone' => ['sometimes', 'string'],
            'avatar' => [
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
            ],
            'gender' => ['sometimes', 'string', new EnumValue(PlayerGenderEnum::class)],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            if ($this->filled('available') && $this->filled('pending')) {
                throw ValidationException::withMessages([
                    'available' => 'pending:cannot_present_same_time',
                    'pending' => 'available:cannot_present_same_time',
                ]);
            }
        });
    }
}
