<?php

namespace App\Http\Requests\patient;

use Illuminate\Foundation\Http\FormRequest;

class NewPatientRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "full_name" => 'required|string',
            "phone_number" => [
                'required',
                'regex:/^(08|628)[0-9]{8,11}$/'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'phone number format not valid (08xxxxxxxxxx).',
        ];
    }
}
