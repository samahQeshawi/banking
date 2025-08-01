<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'يجب أن يكون العنوان نصًا.',
            'title.max' => 'يجب ألا يزيد العنوان عن 255 حرفًا.',
            'desc.required' => 'حقل الوصف مطلوب.',
            'desc.string' => 'يجب أن يكون الوصف نصًا.',
            'image.image' => 'يجب أن تكون الصورة من نوع صورة صالح.',
        ];
    }
}
