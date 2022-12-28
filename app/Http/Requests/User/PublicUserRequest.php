<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Regex;
use App\Constants\RequestValidate;
use App\Models\Auth\Role;

class PublicUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'username' => RequestValidate::UserValidate(),
            'email' => "required|email|max:255|unique:users,email|regex:$email",
            'password' => "required|max:255|min:8|regex:$password",
            'role_ids' => 'array',
            'mobile' => "nullable|regex:$mobile|not_regex:$mobile_not_regex|min:10|max:10|unique:users,mobile",
        ];

        if ($this->role_ids && Role::whereIn('id', $this->role_ids)->where('department_require', true)->count()) {
            $rules['department_id'] = 'required';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'role_ids.required' => 'Role User is required',
            'password.regex' => Regex::PASSWORD_MESSAGE,
            'username.regex' => Regex::USERNAME_MESSAGE,
            'email.regex' => Regex::EMAIL_MESSAGE
        ];
    }
}
