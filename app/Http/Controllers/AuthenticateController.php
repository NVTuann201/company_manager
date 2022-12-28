<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\WebAuthRequest;
use Illuminate\Support\Facades\Cookie;


class AuthenticateController extends Controller
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('sanctum.expiration'),
        ]);
    }
    public function webAuthenticate(WebAuthRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if ($this->checkEmail($credentials["username"])) {
            $credentials["email"] = $credentials["username"];
            unset($credentials["username"]);
        }
        if (!empty($credentials['email'])) {
            $user = User::where('email', 'ilike', $credentials['email'])->with(['roles'])->first();
        } else {
            $user = User::where('username', 'ilike', $credentials['username'])->with(['roles'])->first();
        }

        $token = $user->createToken('login_token');
        Cookie::make('token', $token->plainTextToken);

        return $this->respondWithToken($token->plainTextToken);
    }
}