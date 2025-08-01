<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'full_name' => 'required|string|max:50',
            'phone' => 'required|unique:customers,phone|regex:/^(966)[0-9]{9}$/',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.string' => 'الاسم الكامل يجب أن يكون نصًا.',
            'full_name.max' => 'الاسم الكامل يجب ألا يزيد عن 50 حرفًا.',

            'phone.required' => 'رقم الجوال مطلوب.',
            'phone.unique' => 'رقم الجوال مستخدم من قبل.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ];
    }
}
