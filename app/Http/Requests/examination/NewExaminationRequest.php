<?php

namespace App\Http\Requests\examination;

use Illuminate\Foundation\Http\FormRequest;

class NewExaminationRequest extends FormRequest
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
            "patient"           => "required|string",
            "height"            => "nullable|regex:/^[0-9]{2,3}$/",
            "weight"            => "nullable|regex:/^[0-9]{2,3}$/",
            "systole"           => "nullable|regex:/^[0-9]{2,3}$/",
            "diastole"          => "nullable|regex:/^[0-9]{2,3}$/",
            "heart_rate"        => "nullable|regex:/^[0-9]{2,3}$/",
            "respiration_rate"  => "nullable|regex:/^[0-9]{2,3}$/",
            "body_temp"         => "nullable|regex:/^[0-9]{2,3}$/",
            "doctor_notes"      => "required|string",
            "medicines"         => 'required|array|min:1',
            'medicines.*.id'    => 'required|string',
            'medicines.*.name'  => 'required|string',
            'medicines.*.qty'   => 'required|integer|min:1|max:999',
            'attachments'        => 'nullable|array',
            'attachments.*'      => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120'
        ];
    }

    public function messages()
    {
        return [
            "height.regex"          => "Please fill a valid height!",
            "attachments.*.mimes"    => "File type not allowed",
            "attachments.*.max"      => "maximum file size is 5MB"
        ];
    }
}
