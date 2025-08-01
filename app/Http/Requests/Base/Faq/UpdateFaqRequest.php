<?php

namespace App\Http\Requests\Base\Faq;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
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
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|min:3|max:255',
            'language' => 'nullable|string|min:3|max:',
            'position' => 'nullable|int',
            'status' => 'required|boolean',
        ];
    }
}
