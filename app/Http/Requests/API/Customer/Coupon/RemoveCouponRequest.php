<?php

namespace App\Http\Requests\API\Customer\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class RemoveCouponRequest extends FormRequest
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
            'uuid' => 'required|string',
            'code' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'discount_amount' => 'required|numeric',
            'discount_type' => 'required|in:fixed,percentage',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|boolean',
            'usage_limit' => 'nullable|int',
            'usage_limit_per_user' => 'nullable|int',
        ];
    }
}
