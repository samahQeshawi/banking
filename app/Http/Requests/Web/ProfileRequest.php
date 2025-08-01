<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       $userId = optional($this->user('admin'))->id;

       $rules = [
        'name' => 'required|min:3',
        'email' => ['required', 'email', Rule::unique('admins', 'email')->ignore($userId)],
        'phone' => ['required', 'regex:/^\+[1-9][0-9]{7,15}$/'],
        'old_password' => ['nullable', function ($attribute, $value, $fail) {
            if ($this->filled('old_password') && !Hash::check($value, $this->user('admin')->password)) {
                $fail('كلمة المرور القديمة غير صحيحة');
            }
        }],
        'password' => ['nullable', 'min:6', 'confirmed', 
                              'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
        'password_confirmation' => ['nullable'],
       ];

      return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'هذا الحقل مطلوب.',
            'name.min' => 'يجب ان يكون الاسم  من 3 أحرف أو أكثر.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحاً.',
            'email.unique' => 'البريد الالكتروني موجود مسبقاً.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'صيغة حقل رقم الجوال غير صحيحة',

            'password.confirmed' => 'كلمة المرور الجديدة غير متطابقة',
        ];
    }

    public function passedValidation()
    {
        if ($this->filled('old_password') && $this->filled('password')) {
            $this->merge(['password' => bcrypt($this->password)]);
        } else {
            $this->merge(['password' => $this->user('admin')->password]);
        }
    }
}
