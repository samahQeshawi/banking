<?php

namespace App\Http\Requests\Base\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'menu_id' => 'required|int|exists:menus,id',
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'calories' => 'nullable|int',
            'featured' => 'required|boolean',
            'image' => 'nullable|string|min:3|max:255',
            'is_available' => 'required|boolean',
            'status' => 'required|boolean',
            'sort_order' => 'required|int',
        ];
    }
}
