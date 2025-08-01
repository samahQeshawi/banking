<?php

namespace App\Http\Requests\NotificationTemplate;

use Illuminate\Foundation\Http\FormRequest;

class ListNotificationTemplateRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string',
            'metadata' => 'nullable|json',
        ];
    }
}
