<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $restaurant = $this->route('restaurant');
        $restaurantId = $restaurant->id;

        return [
            // Step 1: Account Details
            'owner_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'numeric',
                'regex:/^\+[1-9][0-9]{7,15}$/',
                 Rule::unique('restaurants', 'phone')->ignore($restaurantId),
            ],
            'operator_phone' => 'nullable|numeric|regex:/^\+[1-9][0-9]{7,15}$/',
            'marketing_phone' => 'nullable|numeric|regex:/^\+[1-9][0-9]{7,15}$/',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('restaurants', 'email')->ignore($restaurantId),
            ],
            'password' => ['nullable', 'string', 'min:6',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],

            // Step 2: Kitchen Details
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('restaurants', 'name')->ignore($restaurantId),
            ],
            'order_type' => 'required|in:current,scheduled',
            'section_id' => 'required',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',

            // Step 3: Location & Working Hours
            'latitude' => 'required',
            'longitude' => 'required',

            'days' => 'required|array',
            'days.*.active' => 'nullable|in:on,0,1,true,false',
            'days.*.from' => 'nullable|required_with:days.*.active|date_format:H:i',
            'days.*.to' => 'nullable|required_with:days.*.active|date_format:H:i|after:days.*.from',
        ];
    }

    public function messages()
    {
        return [
            // Step 1: Account Details
            'owner_name.required' => 'حقل الاسم مطلوب.',
            'owner_name.string' => 'الاسم يجب أن يكون نصًا.',
            'owner_name.max' => 'الاسم لا يجب أن يتجاوز 255 حرفًا.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.numeric' => 'يجب أن يكون رقم الهاتف أرقامًا فقط.',
            'phone.regex' => 'رقم الهاتف يجب أن يكون بين 8 و 15 رقمًا.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'operator_phone.regex' => 'رقم الهاتف يجب أن يكون بين 8 و 15 رقمًا.',
            'marketing_phone.regex' => 'رقم الهاتف يجب أن يكون بين 8 و 15 رقمًا.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون بريدًا إلكترونيًا صحيحًا.',
            'email.max' => 'البريد الإلكتروني لا يجب أن يتجاوز 255 حرفًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.string' => 'كلمة المرور يجب أن تكون نصية.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 6 أحرف.',
            'password.regex' => 'يجب أن تحتوي كلمة المرور على حروف وأرقام.',

            // Step 2: Kitchen Details
            'name.required' => 'اسم المطبخ مطلوب.',
            'name.string' => 'اسم المطبخ يجب أن يكون نصًا.',
            'name.max' => 'اسم المطبخ لا يجب أن يتجاوز 255 حرفًا.',
            'name.unique' => ' اسم المطبخ مستخدم بالفعل.',

            'order_type.required' => 'يجب اختيار نوع التسليم.',
            'order_type.in' => 'نوع التسليم المختار غير صالح.',

            'section_id.required' => 'يجب اختيار القسم.',

            'category_ids.required' => 'يجب اختيار تصنيف المطبخ.',
            'category_ids.array' => 'يجب أن يتم تحديد تصنيف المطبخ بطريقة صحيحة.',
            'category_ids.*.exists' => 'تصنيف المطبخ المحدد غير موجود.',

            // Step 3: Location & Working Hours
            'latitude.required' => 'يجب تحديد الموقع على الخريطة.',
            'latitude.numeric' => 'إحداثيات خط العرض غير صالحة.',
            'latitude.between' => 'إحداثيات خط العرض غير صالحة.',

            'longitude.required' => 'يجب تحديد الموقع على الخريطة.',
            'longitude.numeric' => 'إحداثيات خط الطول غير صالحة.',
            'longitude.between' => 'إحداثيات خط الطول غير صالحة.',

            'days.required' => 'يجب تحديد أيام وأوقات العمل.',
            'days.array' => 'صيغة الأيام غير صحيحة.',

            'days.*.active.in' => 'قيمة تفعيل اليوم غير صالحة.',

            'days.*.from.required_with' => 'وقت البداية مطلوب إذا كان اليوم مفعلًا.',
            'days.*.from.date_format' => 'وقت البداية يجب أن يكون بتنسيق صحيح (ساعة:دقيقة).',

            'days.*.to.required_with' => 'وقت النهاية مطلوب إذا كان اليوم مفعلًا.',
            'days.*.to.date_format' => 'وقت النهاية يجب أن يكون بتنسيق صحيح (ساعة:دقيقة).',
            'days.*.to.after' => 'يجب أن يكون وقت النهاية بعد وقت البداية.',
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'password' => $this->filled('password') ?? Hash::make($this->password),
        ]);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^0-9]/', '', $this->phone), // remove +
            'operator_phone' => preg_replace('/[^0-9]/', '', $this->operator_phone),
            'marketing_phone' => preg_replace('/[^0-9]/', '', $this->marketing_phone),
        ]);

        foreach (['logo', 'identity_attached', 'iban_attached', 'freelancer_attached'] as $field) {
            if ($this->hasFile($field)) {
                $file = $this->file($field);
                $path = $file->store('temp', 'public');
                session()->put($field, [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            } elseif (session($field)) {
                $sessionFile = session($field);
                $fullPath = storage_path('app/public/'.$sessionFile['path']);

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
