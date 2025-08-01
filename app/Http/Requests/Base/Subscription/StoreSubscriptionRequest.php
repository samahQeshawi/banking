<?php

namespace App\Http\Requests\Base\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'description' => 'nullable|string',
            'price' => 'required|decimal:2,10',
            'duration' => 'required|int',
        ];
    }
}
