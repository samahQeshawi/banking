<?php

namespace App\Http\Requests\Base\OrderTime;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderTimeRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'status' => 'required|boolean',
        ];
    }
}
