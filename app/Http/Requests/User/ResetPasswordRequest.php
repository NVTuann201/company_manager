<?php

namespace App\Http\Requests\User;

use App\Constants\Regex;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        $password = Regex::PASSWORD_REGEX;
        $email = Regex::EMAIL_REGEX;
        return [
            //
            'password_confirmation' => 'required|max:255|min:8',
            'password' => "required|max:255|min:8|required_with:password_confirmation|same:password_confirmation|regex:$password",
            "token" => "required",
            "email" => "required|regex:$email"
        ];
    }
}
