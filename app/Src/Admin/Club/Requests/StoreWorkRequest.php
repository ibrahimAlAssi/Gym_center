<?php

namespace App\Src\Admin\Club\Requests;

use App\Domains\Club\Enums\WorkDayEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
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
            'day' => ['required', 'string', new EnumValue(WorkDayEnum::class)],
            'man_from' => ['sometimes', 'required_with:man_to', 'date_format:g:i A', 'before:man_to'],
            'man_to' => ['sometimes', 'required_with:man_from', 'date_format:g:i A', 'after:man_from'],
            'woman_from' => ['sometimes', 'required_with:woman_to', 'date_format:g:i A', 'before:woman_to'],
            'woman_to' => ['sometimes', 'required_with:woman_from', 'date_format:g:i A', 'after:woman_from'],
        ];
    }
}
