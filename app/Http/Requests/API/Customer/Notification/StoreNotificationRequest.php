<?php

namespace App\Http\Requests\API\Customer\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'notifiable_id' => 'required|int',
            'notifiable_type' => 'required|string|min:3|max:255',
            'options' => 'required|json',
            'data' => 'required|json',
            'read_at' => 'nullable|date',
        ];
    }
}
