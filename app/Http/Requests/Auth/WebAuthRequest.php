<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class WebAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'username' => ['required', 'string'],
            'password' => 'required|string|min:8'
        ];
    }
    public function messages()
    {
        return [
            "username.required"  => "Email or username is required."
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'username' => trim(mb_strtolower($this->username)),
        ]);
    }
}
