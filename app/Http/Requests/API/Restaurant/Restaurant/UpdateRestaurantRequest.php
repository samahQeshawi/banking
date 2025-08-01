<?php

namespace App\Http\Requests\API\Restaurant\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
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

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:3|max:255',
            'photo' => 'nullable|string',
            'language' => 'nullable|in:en,ar',
            'notification_settings' => ['nullable', 'array'],
            'notification_settings.notification_sound' => [
                'nullable',
                'string',
                Rule::in(['with_sound', 'silent']),
            ],
            'notification_settings.notification_channel' => [
                'nullable',
                'string',
                Rule::in(['in_app', 'outside_app']),
            ],
            'activity' => 'nullable|boolean',
        ];
    }
}
