<?php

namespace App\Http\Requests\Base\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'email' => 'nullable|string|min:3|max:255',
            'phone' => 'required|string|min:3|max:255',
            'password' => 'nullable|string|min:3|max:255',
            'photo' => 'nullable|string|min:3|max:255',
            'otp' => 'nullable|string|min:3|max:255',
            'is_verified' => 'required|boolean',
            'fcm_token' => 'nullable|string|min:3|max:255',
            'api_token' => 'nullable|string|min:3|max:80',
            'email_verified_at' => 'nullable|date',
            'language' => 'required|in:ar,en',
            'remember_token' => 'nullable|string|min:3|max:100',
        ];
    }
}
