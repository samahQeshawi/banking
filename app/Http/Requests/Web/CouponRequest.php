<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $couponId = $this->route('coupon'); // for update
        $isRestaurantCoupon = Route::is('admin.restaurants-coupons.*');

        return [
            'code' => ['required', 'string', 'max:255', 'unique:coupons,code'.($couponId ? ",$couponId" : '')],
            'description' => ['nullable', 'string'],
            'discount_amount' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'in:fixed,percentage'],
            'type' => ['required'],
            'restaurant_id' => [$isRestaurantCoupon ? 'required' : 'nullable'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'usage_limit' => ['required', 'integer', 'min:1'],
            'usage_limit_per_user' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'يرجى إدخال رمز الكوبون.',
            'code.unique' => 'رمز الكوبون مستخدم من قبل.',
            'code.max' => 'يجب ألا يتجاوز رمز الكوبون 255 حرفًا.',

            'type.required' => 'يرجى اختيار نوع الكوبون.',

            'restaurant_id.required' => 'يرجى اختيار اسم المطبخ.',

            'discount_amount.required' => 'يرجى إدخال قيمة الخصم.',
            'discount_amount.numeric' => 'قيمة الخصم يجب أن تكون رقمًا.',
            'discount_amount.min' => 'قيمة الخصم يجب أن تكون على الأقل 0.',

            'discount_type.required' => 'يرجى اختيار نوع الخصم.',
            'discount_type.in' => 'نوع الخصم يجب أن يكون إما نسبة مئوية أو مبلغ ثابت.',

            'start_date.required' => 'يرجى إدخال تاريخ البدء.',
            'start_date.date' => 'تاريخ البدء غير صالح.',

            'end_date.required' => 'يرجى إدخال تاريخ الانتهاء.',
            'end_date.date' => 'تاريخ الانتهاء غير صالح.',
            'end_date.after_or_equal' => 'يجب أن يكون تاريخ الانتهاء بعد أو يساوي تاريخ البدء.',

            'usage_limit.required' => 'يرجى تحديد الحد الأقصى لاستخدام الكوبون.',
            'usage_limit.integer' => 'الحد الأقصى للاستخدام يجب أن يكون رقمًا صحيحًا.',
            'usage_limit.min' => 'الحد الأدنى للاستخدام هو 1.',

            'usage_limit_per_user.required' => 'يرجى تحديد الحد لكل مستخدم.',
            'usage_limit_per_user.integer' => 'عدد الاستخدامات لكل مستخدم يجب أن يكون رقمًا صحيحًا.',
            'usage_limit_per_user.min' => 'الحد الأدنى لكل مستخدم هو 1.',
        ];
    }
}
