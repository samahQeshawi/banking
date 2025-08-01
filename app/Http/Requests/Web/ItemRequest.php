<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $restaurant = auth('restaurant')->user();
        // $itemId= request()->route('item');
        if (request()->method() == 'POST') {
            return [
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'menu_id' => 'required|exists:menus,id',
                'name' => [
                    'required',
                    'min:3',
                    Rule::unique('items', 'name')->where(function ($query) use ($restaurant) {
                        return $query->where('restaurant_id', $restaurant->id);
                    }),
                ],
                'price' => 'required|numeric',
                'sort_order' => 'required|integer',
                'description' => 'nullable',
            ];
        } elseif (request()->method() == 'PUT' || request()->method() == 'PATCH') {
            $itemId = request()->route('item');

            return [
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'menu_id' => 'required|exists:menus,id',
                'name' => [
                    'required',
                    'min:3',
                    Rule::unique('items', 'name')->where(function ($query) use ($restaurant) {
                        return $query->where('restaurant_id', $restaurant->id);
                    })->ignore($itemId),
                ],
                'price' => 'required|numeric',
                'sort_order' => 'required|integer',
                'description' => 'nullable',
            ];
        }

    }

    public function messages()
    {
        return [
            'image.required' => __('حقل الصورة مطلوب'),
            'image.image' => __('يجب أن يكون الملف صورة'),
            'image.mimes' => __('يجب أن تكون الصورة بصيغة: jpeg, png, jpg, gif'),
            'image.max' => __('يجب ألا يتجاوز حجم الصورة 2 ميغابايت'),

            'menu_id.required' => __('القائمة مطلوبة'),

            'name.required' => __('حقل اسم المنتج مطلوب'),
            'name.min' => __('يجب أن يكون الاسم على الأقل 3 أحرف'),
            'name.unique' => __('هذا الاسم موجود بالفعل'),

            'price.required' => __('حقل السعر مطلوب'),
            'price.numeric' => __('يجب أن يكون السعر رقمًا'),

            'sort_order.required' => __('ترتيب العرض مطلوب'),
            'sort_order.integer' => __('يجب أن يكون ترتيب العرض رقمًا صحيحًا'),
        ];
    }
}
