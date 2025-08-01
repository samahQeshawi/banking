<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       $adminId = $this->route('admin');

       $rules = [
        'name' => 'required|min:3',
        'phone' => ['required','regex:/^\+[1-9][0-9]{7,15}$/'],
        'old_password' => ['nullable', function ($attribute, $value, $fail) {
            if ($this->filled('old_password') && !Hash::check($value, $this->user('admin')->password)) {
                $fail('كلمة المرور القديمة غير صحيحة');
            }
        }],
        'password_confirmation' => ['nullable'],
        'role_id' => ['required'],
       ];

       if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'min:6', 'confirmed',
                              'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'];
            $rules['email'] = ['required', 'email', Rule::unique('admins', 'email')];
       } else {
            $rules['password'] = ['nullable', 'min:6', 'confirmed', 
                              'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/' ];
            $rules['email'] = ['required', 'email', Rule::unique('admins', 'email')->ignore($adminId)];

       }

      return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'هذا الحقل مطلوب.',
            'name.min' => 'يجب ان يكون الاسم  من 3 أحرف أو أكثر.',

            'role_id.required' => 'هذا الحقل مطلوب.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحاً.',
            'email.unique' => 'البريد الالكتروني موجود مسبقاً.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون بين 8 و 15 رقمًا.',
            
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حروف وأرقام.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 6 أحرف.',

        ];
    }

    public function passedValidation()
    {
        if ($this->filled('password')) {
            $this->merge(['password' => bcrypt($this->password)]);
        } else {
            $this->merge(['password' => $this->user('admin')->password]);
        }
    }

    protected function prepareForValidation()
    {
        foreach (['photo'] as $field) {
        if ($this->hasFile($field)) {
            $file = $this->file($field);
            $path = $file->store('temp', 'public');
            session()->put($field, [
              'path' => $path,
              'original_name' => $file->getClientOriginalName(),
            ]);
        } elseif (session($field)) {
            $sessionFile = session($field);
            $fullPath = storage_path('app/public/' . $sessionFile['path']);

            if (file_exists($fullPath)) {
                $this->files->set($field, new \Illuminate\Http\UploadedFile(
                    $fullPath,
                    $sessionFile['original_name'],
                    null,
                    null,
                    true
                ));
            }
        }
      }
    }
}
