<?php

namespace App\Http\Requests\Base\Cart;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'coupon_id' => 'nullable|int|exists:coupons,id',
            'order_id' => 'nullable|int|exists:orders,id',
            'subtotal' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ];
    }
}
