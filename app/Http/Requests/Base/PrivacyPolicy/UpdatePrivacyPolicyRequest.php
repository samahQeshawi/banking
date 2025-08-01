<?php

namespace App\Http\Requests\Base\PrivacyPolicy;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacyPolicyRequest extends FormRequest
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
            'content' => 'required|string',
            'language' => 'nullable|string|min:3|max:',
            'version' => 'nullable|string|min:3|max:50',
            'is_active' => 'required|boolean',
        ];
    }
}
