<?php

namespace App\Src\Coach\Entities\Requests;

use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use App\Domains\Products\Enums\ItemStatusEnum;

/**
 * @property mixed $name
 * @property mixed $id
 * @property mixed $description
 * @property mixed $weight
 * @property mixed $quantity
 * @property mixed $status
 */
class UpdateImageRequest extends FormRequest
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
            'avatar' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Maximum file size in kilobytes
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000), // Maximum dimensions in pixels
            ],
        ];
    }
}
