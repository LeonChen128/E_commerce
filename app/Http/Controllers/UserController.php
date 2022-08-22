<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use \App\Model\User;

class UserController extends Controller
{
    public function __construct(Request $request)
    {

    }

    public function profile(Request $request)
    {
        return view('user/profile', [
            'user' => Auth::user()->jsonFormat()
        ]);
    }

    public function password(Request $request)
    {
        return view('user/password', [
            'user' => Auth::user()->jsonFormat()
        ]);
    }
}
