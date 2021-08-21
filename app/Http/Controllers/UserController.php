<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        
    }

    public function index(Request $request)
    {
        // $users = User::all();
        return view('user/index', [
            'message' => 'well done'
            // 'users' => [
            //     [
            //         'id' => 1,
            //         'name' => 'Leon'
            //     ],
            //     [
            //         'id' => 2,
            //         'name' => 'Linda'
            //     ]
            // ]
        ]);
    }
}
