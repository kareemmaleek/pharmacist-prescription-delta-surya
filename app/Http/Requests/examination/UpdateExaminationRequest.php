<?php

namespace App\Http\Requests\examination;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExaminationRequest extends FormRequest
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
            "height"            => "sometimes|nullable|numeric|min:0|max:300",
            "weight"            => "sometimes|nullable|numeric|min:0|max:300",
            "systole"           => "sometimes|nullable|numeric|min:0|max:1000",
            "diastole"          => "sometimes|nullable|numeric|min:0|max:1000",
            "heart_rate"        => "sometimes|nullable|numeric|min:0|max:1000",
            "respiration_rate"  => "sometimes|nullable|numeric|min:0|max:1000",
            "body_temp"         => "sometimes|nullable|numeric|min:0|max:200|decimal:1",
            "doctor_notes"      => "sometimes|string",
            "medicines"         => 'sometimes|array|min:1',
            'medicines.*.id'    => 'sometimes|string',
            'medicines.*.name'  => 'sometimes|string',
            'medicines.*.qty'   => 'sometimes|integer|min:1|max:999',
        ];
    }

     public function messages()
    {
        return [
            "height.regex"          => "Please fill a valid height!"
        ];
    }
}
