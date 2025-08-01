<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerId = $this->route('user');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'nullable|email|max:255|unique:customers,email'.($customerId ? ",$customerId" : ''),
            'phone' => 'required|max:12|regex:/^[0-9]+$/|unique:customers,phone'.($customerId ? ",$customerId" : ''),
            'photo' => ['nullable', 'image', 'max:2048'],
        ];

        // if ($this->isMethod('post') || $this->filled('password')) {
        //     $rules['password'] = 'required|string|min:6|confirmed';
        // } else {
        //     $rules['password'] = 'nullable|string|min:6|confirmed';
        // }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الرجاء إدخال الاسم.',
            'name.string' => 'الاسم يجب أن يكون نصًا.',
            'name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',

            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقًا.',

            'phone.required' => 'الرجاء إدخال رقم الهاتف.',
            'phone.unique' => 'رقم الهاتف مستخدم مسبقًا.',

            'password.required' => 'الرجاء إدخال كلمة المرور.',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا.',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',
            'password.confirmed' => 'كلمة المرور غير متطابقة.',

            'photo.image' => 'يجب أن يكون الملف صورة.',
            'photo.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميغابايت.',
        ];
    }

    public function passedValidation()
    {
        $otp = rand(1000, 9999);
        $this->merge([
            'otp' => $otp,
            'password' => $otp,
        ]);
    }

    protected function prepareForValidation()
    {
        if ($this->hasFile('photo')) {
            $path = $this->file('photo')->store('temp', 'public');
            session()->flash('photo_temp', $path);
        }
    }
}
