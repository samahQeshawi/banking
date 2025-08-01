<?php

namespace App\Http\Requests\Base\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'restaurant_id' => 'nullable|int|exists:restaurants,id',
            'menu_id' => 'nullable|int|exists:menus,id',
            'name' => 'nullable|string|min:3|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|decimal:2,10',
            'calories' => 'nullable|int',
            'featured' => 'nullable|boolean',
            'image' => 'nullable|string|min:3|max:255',
            'is_available' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|int',
        ];
    }
}
