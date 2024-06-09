<?php

namespace App\Src\Admin\Plans\Requests;

use App\Domains\Plans\Enums\PlanTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlanRequest extends FormRequest
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
            'name' => ['sometimes', 'string', Rule::unique('plans', 'name')->ignore($this->plan->id)],
            'type' => ['sometimes', 'string', new EnumValue(PlanTypeEnum::class)],
            'cost' => ['sometimes', 'numeric', 'min:0'],
            'image' => ['nullable', 'image'],
            'services' => ['sometimes', 'array', 'min:1', Rule::exists('services', 'id')],
            'services.*' => ['required', 'integer'],
        ];
    }
}
