<?php

namespace App\Http\Requests\Base\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $userId = $this->route('customer')?->id ?? auth()->id();

        return [
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
                Rule::unique('customers', 'email')->ignore($userId),
            ],
            'phone' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('customers', 'phone')->ignore($userId),
            ],
            'password' => 'nullable|string|min:3|max:255',
            'photo' => 'nullable|string|min:3|max:255',
            'otp' => 'nullable|string|min:3|max:255',
            'is_verified' => 'required|boolean',
            'fcm_token' => 'nullable|string|min:3|max:255',
            'email_verified_at' => 'nullable|date',
            'language' => 'required|in:ar,en',
            'remember_token' => 'nullable|string|min:3|max:100',
        ];
    }
}
