<?php
/**
 * Created by PhpStorm.
 * User: Jory|jorycn@163.com
 * Date: 2016/6/28
 * Time: 15:08
 */
namespace App\Http\Controllers\OAuth;

use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}