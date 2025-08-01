<?php

namespace App\Http\Requests\Base\Order;

use App\Enums\OrderListType;
use App\Enums\OrderMethods;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListOrderRequest extends FormRequest
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
            'order_list_type' => ['nullable', Rule::in(array_column(OrderListType::cases(), 'value'))],
            'order_method' => ['nullable', Rule::in(OrderMethods::cases(), 'value')],
            'due_at' => ['nullable', 'date'],
        ];
    }
}
