<?php

namespace App\Http\Requests\Base\WorkingHour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkingHourRequest extends FormRequest
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
            'restaurant_id' => 'required|int|exists:restaurants,id',
            'day_of_week' => 'required|in:saturday,sunday,monday,tuesday,wednesday,thursday,friday',
            'open_time' => 'required|date',
            'close_time' => 'required|date',
        ];
    }
}
