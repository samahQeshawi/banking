<?php

namespace App\Http\Requests\Base\ItemAdditionOption;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemAdditionOptionRequest extends FormRequest
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
            'item_addition_id' => 'required|int|exists:item_additions,id',
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric',
        ];
    }
}
