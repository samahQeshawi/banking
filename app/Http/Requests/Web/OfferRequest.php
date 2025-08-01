<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //        $offerId = $this->route('offer');

        return [
            'offer_type_id' => ['required', 'exists:offer_types,id'],
            'type' => ['required', 'in:fixed,percentage'],
            'value' => ['required', 'numeric'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after_or_equal:start'],
        ];
    }

    public function messages(): array
    {
        return [
            'offer_type_id.required' => 'الرجاء اختيار نوع العرض.',
            'offer_type_id.exists' => 'نوع العرض المحدد غير موجود.',

            'type.required' => 'الرجاء اختيار نوع الخصم.',
            'type.in' => 'نوع الخصم يجب أن يكون إما نسبة مئوية أو مبلغ ثابت.',

            'value.required' => 'الرجاء إدخال قيمة الخصم.',
            'value.numeric' => 'قيمة الخصم يجب أن تكون رقمًا.',

            'start.required' => 'الرجاء إدخال تاريخ البداية.',
            'start.date' => 'تاريخ البداية غير صالح.',

            'end.required' => 'الرجاء إدخال تاريخ النهاية.',
            'end.date' => 'تاريخ النهاية غير صالح.',
            'end.after_or_equal' => 'تاريخ النهاية يجب أن يكون بعد أو يساوي تاريخ البداية.',
        ];
    }
}
