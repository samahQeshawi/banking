<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الاشتراك مطلوب.',
            'name.string' => 'يجب أن يكون اسم الاشتراك نصاً.',
            'name.max' => 'اسم الاشتراك لا يجب أن يتجاوز 255 حرفاً.',

            'description.string' => 'يجب أن يكون الوصف نصاً.',

            'price.required' => 'سعر الاشتراك مطلوب.',
            'price.numeric' => 'يجب أن يكون السعر رقماً.',
            'price.min' => 'يجب ألا يقل السعر عن 0.',

            'duration.required' => 'مدة الاشتراك مطلوبة.',
            'duration.integer' => 'يجب أن تكون المدة رقماً صحيحاً.',
            'duration.min' => 'يجب ألا تقل المدة عن شهر واحد.',
        ];
    }
}
