<?php

namespace App\Http\Requests\Base\Order;

use App\Enums\OrderMethods;
use App\Enums\PaymentTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|int|exists:restaurants,id',
            'address_id' => 'required|int|exists:addresses,id',
            'coupon_id' => 'nullable|int|exists:coupons,id',
            'order_method' => ['nullable', 'string', Rule::in(array_column(OrderMethods::cases(), 'value'))],
            'payment_type' => ['nullable', 'string', Rule::in(array_column(PaymentTypes::cases(), 'value'))],
            'order_items' => 'nullable|array',
            'note' => 'nullable|string',
        ];
    }
}
