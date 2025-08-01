<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $restaurantId = auth('restaurant')->id();
        $menuId = $this->route('menu');
        $titleRule = Rule::unique('menus', 'name')->where('restaurant_id', $restaurantId);

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $titleRule->ignore($menuId);
        }

        return [
            'title' => [
                'required',
                'min:3',
                $titleRule,
            ],
            'image' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'اسم التصنيف موجود مسبقاً.',
            'title.min' => 'يجب ان يكون طول نص حقل الإسم على الأقل 3 حروف.',
            'image.required' => 'الصورة مطلوبة.',
            'image.image' => 'يجب أن يكون الملف صورة.',
            'image.mimes' => 'يجب أن تكون الصورة من نوع: jpeg, png, jpg, gif.',
            'image.max' => 'يجب ألا تتجاوز الصورة 2 ميغابايت.',
        ];
    }

    public function passedValidation()
    {
        $restaurantId = auth('restaurant')->id();
        $this->merge([
            'restaurant_id' => $restaurantId,
            'name' => $this->input('title'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $key = $this->isMethod('post') ? 'add' : 'edit';
        throw new HttpResponseException(
            redirect()->back()
                ->with($key, true)
                ->withErrors($validator)
                ->withInput()
        );
    }

    protected function prepareForValidation()
    {
        if ($this->hasFile('image')) {
            $path = $this->file('image')->store('temp', 'public');
            session()->flash('photo_temp', $path);
        }
    }
}
