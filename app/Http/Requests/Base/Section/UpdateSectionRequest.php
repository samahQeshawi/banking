<?php

namespace App\Http\Requests\Base\Section;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ];
    }
}
