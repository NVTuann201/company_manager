<?php

namespace App\Http\Requests\User;

use App\Constants\Regex;
use App\Constants\RequestValidate;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $username = Regex::USERNAME_REGEX;
        $password = Regex::PASSWORD_REGEX;
        $mobile = Regex::MOBILE_REGEX;
        $mobile_not_regex = Regex::MOBILE_NOT_REGEX;
        $email = Regex::EMAIL_REGEX;
        return [
            'name' => 'required|max:255',
            'username' => RequestValidate::UserValidate(),
            'email' => "required|email|max:255|unique:users|regex:$email",
            'password' => "required|max:255|min:8|regex:$password",
            'mobile' => "nullable|regex:$mobile|not_regex:$mobile_not_regex|min:10|max:10|unique:users,mobile",
            'confirm_password' => 'required|max:255|required_with:confirm_password|same:confirm_password|min:8',
        ];
    }
}
