<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends \App\Http\Controllers\Controller
{
    public function __construct(Request $request)
    {
        
    }

    public function login(Request $request)
    {
        $params = $this->validate($request, [
            'account' => '',
            'password' => ''
        ]);

        if (!$user = User::where('account', $params['account'])->where('password', md5($params['password']))->first()) {
            return response()->json(['message' => '帳密有誤'], 400);
        }

        Auth::login($user);
        
        return response()->json(['message' => '登入成功']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => '登出成功']);
    }

    public function check(Request $request)
    {
        $user = Auth::user();

        return response()->json(
            $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'account' => $user->account,
            ] : []
        );
    }
}
