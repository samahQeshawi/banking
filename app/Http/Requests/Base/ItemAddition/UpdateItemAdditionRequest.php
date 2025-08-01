<?php

namespace App\Http\Requests\Base\ItemAddition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemAdditionRequest extends FormRequest
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
            'item_id' => 'required|int|exists:items,id',
            'title' => 'required|string|min:3|max:255',
            'required' => 'required|boolean',
            'min_selection' => 'required|int',
            'max_selection' => 'required|int',
        ];
    }
}
