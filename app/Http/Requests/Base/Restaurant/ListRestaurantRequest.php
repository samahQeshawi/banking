<?php

namespace App\Http\Requests\Base\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class ListRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:3|max:255',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'nullable|int|exists:categories,id',
            'order_time_ids' => 'nullable|array',
            'order_time_ids.*' => 'nullable|int|exists:order_times,id',
            'section_ids' => 'nullable|array',
            'section_ids.*' => 'nullable|int|exists:sections,id',
            'is_suggested' => 'nullable|in:true,false',
            'previous_orders' => 'nullable|in:true,false',
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('category_ids') && is_string($this->category_ids)) {
            $this->merge([
                'category_ids' => explode(',', $this->category_ids),
            ]);
        }
        if ($this->has('section_ids') && is_string($this->section_ids)) {
            $this->merge([
                'section_ids' => explode(',', $this->section_ids),
            ]);
        }
        if ($this->has('order_time_ids') && is_string($this->order_time_ids)) {
            $this->merge([
                'order_time_ids' => explode(',', $this->order_time_ids),
            ]);
        }
    }
}
