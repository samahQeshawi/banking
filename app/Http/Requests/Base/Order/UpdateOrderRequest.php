<?php

namespace App\Http\Requests\Base\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'customer_id' => 'nullable|int|exists:customers,id',
            'restaurant_id' => 'nullable|int|exists:restaurants,id',
            'address_id' => 'nullable|int|exists:addresses,id',
            'coupon_id' => 'nullable|int|exists:coupons,id',
            'order_details' => 'nullable|array',
            'payment_type' => 'nullable|string|min:3|max:255',
            'discount' => 'nullable|numeric',
            'status' => 'nullable|string|min:3|max:255',
            'order_method' => 'nullable|string|min:3|max:255',
            'cancel_reason' => 'nullable|string',
            'is_read_it' => 'nullable|boolean',
            'due_at' => 'nullable|date_format:Y-m-d H:i:s',
            'note' => 'nullable|string',
        ];
    }
}
