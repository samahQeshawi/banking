<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $driverId = $this->route('driver'); // هذا يستخرج الـ ID من المسار (edit/update)

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:12|regex:/^[0-9]+$/|unique:drivers,phone'.($driverId ? ",$driverId" : ''),
            'email' => 'required|email|max:255|unique:drivers,email'.($driverId ? ",$driverId" : ''),
            'vehicle_type' => 'nullable|string|max:255',
            'vehicle_license_plate' => 'nullable|string|max:50|unique:drivers,vehicle_license_plate'.($driverId ? ",$driverId" : ''),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'license_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // if ($this->isMethod('post') || $this->filled('password')) {
        //     $rules['password'] = 'required|string|min:6|confirmed';
        // } else {
        //     $rules['password'] = 'nullable|string|min:6|confirmed';
        // }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'الرجاء إدخال اسم للسائق',
            'phone.required' => 'الرجاء إدخال رقم الهاتف',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',
            'phone.regex' => 'رقم الهاتف يجب أن يحتوي على أرقام فقط',
            'phone.max' => 'رقم الهاتف يجب ألا يزيد عن 12 رقمًا',
            'email.required' => 'الرجاء إدخال البريد الإلكتروني',
            'email.email' => 'الرجاء إدخال بريد إلكتروني صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'الرجاء إدخال كلمة المرور',
            'password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'vehicle_type.string' => 'نوع المركبة يجب أن يكون نصاً',
            'vehicle_license_plate.string' => 'رقم لوحة المركبة يجب أن يكون نصاً',
            'vehicle_license_plate.unique' => 'رقم لوحة المركبة مستخدم بالفعل',
            'photo.image' => 'الملف المرفق يجب أن يكون صورة',
            'photo.mimes' => 'نوع الصورة يجب أن يكون: jpeg, png, jpg, gif',
            'photo.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت',
            'license_photo.image' => 'رخصة القيادة يجب أن يكون صورة',
            'license_photo.mimes' => 'نوع صورة رخصة القيادة يجب أن يكون: jpeg, png, jpg, gif',
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
        if ($this->hasFile('license_photo')) {
            $path = $this->file('license_photo')->store('temp', 'public');
            session()->flash('license_photo_temp', $path);
        }

        if ($this->hasFile('photo')) {
            $path = $this->file('photo')->store('temp', 'public');
            session()->flash('photo_temp', $path);
        }
    }
}
