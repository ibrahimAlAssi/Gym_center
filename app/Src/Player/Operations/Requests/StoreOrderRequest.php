<?php

namespace App\Src\Player\Operations\Requests;

use App\Domains\Operations\Enums\OrderPaymentTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'cart_ids' => ['required', 'array'],
            'cart_ids.*' => ['integer', 'distinct', 'min:1'],
            'payment_type' => ['required', 'string', new EnumValue(OrderPaymentTypeEnum::class)],
        ];
    }
}
