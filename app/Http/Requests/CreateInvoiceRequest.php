<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start' => 'required|string|date',
            'end' => 'required|string|date|after:start',
            'customer_id' => 'required|integer|exists:customers,id'
        ];
    }
}
