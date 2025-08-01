<?php

namespace App\Http\Requests\Base\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'image' => 'required|string|min:3|max:255',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
            'link' => 'nullable|string|min:3|max:255',
            'view' => 'required|int',
            'status' => 'required|boolean',
        ];
    }
}
