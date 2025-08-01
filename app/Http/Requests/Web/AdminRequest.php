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
    //    dd($this->all());
       $rules = [
        'phone' => ['required','regex:/^[0-9]{8,15}$/','exists:admins,phone'],
        'id_number' => 'required',
        'problem' => 'required',
        'delegation_duration' => 'required',
        'agency_number' => 'nullable',
        'max_amount' => 'required',
        'permissions' => 'required',
       ];
      return $rules;
    }

    public function messages(): array
    {
        return [
            'permissions.required' => 'يجب تحديد الصلاحيات للمفوض.',
            'name.required' => 'هذا الحقل مطلوب.',
            'name.min' => 'يجب ان يكون الاسم  من 3 أحرف أو أكثر.',
          
            'problem.required' => 'هذا الحقل مطلوب.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون بين 8 و 15 رقمًا.',
            
            'id_number.required' => 'رقم الهوية الوطنية مطلوب.',
            'delegation_duration.required' => 'مدة التفويض مطلوبة.',
            'agency_number.required' => 'رقم الوكالة مطلوب.',
            'max_amount.required' => 'الحد الأقصى للمبالغ مطلوب.',

            'phone.exists' => 'رقم الجوال غير موجود في النظام.',

        ];
    }


}
