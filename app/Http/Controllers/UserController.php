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

    public function index(Request $request)
    {
        return view('user/index', [
            'user' => [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'account' => Auth::user()->account,
                'address' => Auth::user()->address,
                'phone' => Auth::user()->phone,
            ]
        ]);
    }
}
