<?php

namespace App\Http\Requests\Base\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'phone' => 'required|string|min:3|max:255',
            'email' => 'nullable|string|min:3|max:255',
            'password' => 'required|string|min:3|max:255',
            'otp' => 'nullable|string|min:3|max:255',
            'is_verified' => 'required|boolean',
            'image' => 'nullable|string|min:3|max:255',
            'status' => 'required|boolean',
            'remember_token' => 'nullable|string|min:3|max:100',
        ];
    }
}
