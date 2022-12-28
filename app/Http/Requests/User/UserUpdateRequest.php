<?php

namespace App\Http\Requests\User;

use App\Models\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Regex;
use App\Constants\RequestValidate;
use App\Constants\RoleType;
use App\Models\Auth\Role;

class UserUpdateRequest extends FormRequest
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
        $user = User::where("uuid", $this->id)->first();
        $mobile = Regex::MOBILE_REGEX;
        $mobile_not_regex = Regex::MOBILE_NOT_REGEX;
        $email = Regex::EMAIL_REGEX;
        $rules = [
            'name' => 'required|max:255',
            'last_name' => 'max:255',
            'gender' => 'integer',
            'username' => RequestValidate::UserValidate($user->id),
            'email' => "required|email|max:255|unique:users,email,{$user->getKey()}|regex:$email",
            'mobile' => "nullable|regex:$mobile|not_regex:$mobile_not_regex|min:10|max:10|unique:users,mobile,{$user->getKey()}",
        ];
        if(!empty($this->role_ids) && is_array($this->role_ids) && count($this->role_ids)){
            $roles = Role::whereIn('code', [RoleType::DEPARTMENT_HEAD, RoleType::DEPARTMENT_USER])->whereIn('id', $this->role_ids)->count();
            if($roles){
                $rules["department_id"] = "required";
            }
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'password.regex' => Regex::PASSWORD_MESSAGE,
            'username.regex' => Regex::USERNAME_MESSAGE,
            'email.regex' => Regex::EMAIL_MESSAGE
        ];
    }
}
