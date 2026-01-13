<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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

        $uid = $this->route('uid');

        return [
            'name' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email|unique:users,email,' . $uid . ',uid',
            'role' => 'sometimes|nullable',
            'status' => 'sometimes|nullable',
            'password' => 'sometimes|nullable|min:8|alpha_num|confirmed',
            'password_confirmation' => 'sometimes|nullable'
        ];
    }
}
