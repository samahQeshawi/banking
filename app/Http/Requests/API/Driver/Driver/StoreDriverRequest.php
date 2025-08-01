<?php

namespace App\Http\Requests\API\Driver\Driver;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|unique:drivers,phone',
            'language' => 'required|in:en,ar',
        ];
    }
}
