<?php

namespace App\Http\Requests\Base\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'item_id' => 'required|integer|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'item_additions' => 'nullable|array',
            'item_additions.*.item_addition_id' => 'required|integer|exists:item_additions,id',
            'item_additions.*.item_addition_option_id' => 'required|integer|exists:item_addition_options,id',
            'notes' => 'nullable|string',
        ];
    }
}
