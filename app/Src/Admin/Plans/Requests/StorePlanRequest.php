<?php

namespace App\Src\Admin\Plans\Requests;

use App\Domains\Plans\Enums\PlanTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlanRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('plans', 'name')],
            'type' => ['required', 'string', new EnumValue(PlanTypeEnum::class)],
            'cost' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image'],
            'services' => ['required', 'array', 'min:1', Rule::exists('services', 'id')],
            'services.*' => ['required', 'integer'],
        ];
    }
}
