<?php

namespace App\Http\Requests\Base\CouponUsage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponUsageRequest extends FormRequest
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
            'coupon_id' => 'required|int|exists:coupons,id',
            'order_id' => 'required|int|exists:orders,id',
            'usage_count' => 'required|int',
        ];
    }
}
