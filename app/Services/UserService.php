<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /** Checks authentication of users*/
    public static function validateCredentials($request)
    {
        /** Extract auth data */
        $header = $request->header('Authorization');
        if (is_null($header)) {
            return 'Credentials do not match';
        }

        $headerTrimmed = str_replace('Basic ', '', $header);
        $decodedAuth = base64_decode($headerTrimmed);
        $array = explode(':', $decodedAuth);
        $username = $array[0];
        $password = $array[1];

        /** Validate user */
        $user = User::where('email', $username)->first();
        if (!is_null($user)) {
            if (Hash::check($password, $user->password)) {
                return 'ok';
            } else {
                return 'Password does not match';
            }
        } else {
            return 'User does not match';
        }
    }
}
