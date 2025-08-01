<?php

namespace App\Http\Requests\Base\CartItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
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
            'cart_id' => 'required|integer|exists:carts,id',
            'item_id' => 'required|integer|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',

            'item_additions' => 'nullable|array',
            'item_additions.*.item_addition_id' => 'required|integer|exists:item_additions,id',
            'item_additions.*.item_addition_option_id' => 'required|integer|exists:item_addition_options,id',
            'item_additions.*.quantity' => 'required|integer|min:1',
        ];
    }
}
