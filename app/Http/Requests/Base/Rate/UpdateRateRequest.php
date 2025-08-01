<?php

namespace App\Http\Requests\Base\Rate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|int|exists:customers,id',
            'restaurant_id' => 'required|int|exists:restaurants,id',
            'rate' => 'required|int',
            'comment' => 'nullable|string|min:3|max:255',
        ];
    }
}
