<?php

namespace App\Src\Player\Plans\Requests;

use App\Domains\Plans\Enums\SubscriptionPaymentType;
use BenSampo\Enum\Rules\EnumValue;
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
            'plan_id' => ['required', 'integer'],
            'coach_id' => ['nullable', 'integer', Rule::exists('coaches', 'id')],
            'description' => ['nullable', 'string'],
            'end_date' => ['required', 'date', 'after:now'],
            'payment_type' => ['required', 'string', new EnumValue(SubscriptionPaymentType::class)],
        ];
    }
}
