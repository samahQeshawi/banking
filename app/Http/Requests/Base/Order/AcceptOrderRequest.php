<?php

namespace App\Http\Requests\Base\Order;

use Illuminate\Foundation\Http\FormRequest;

class AcceptOrderRequest extends FormRequest
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
            'due_at' => 'required|date|date_format:Y-m-d H:i:s',
        ];
    }
}
