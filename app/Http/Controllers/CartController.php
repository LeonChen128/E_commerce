<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function __construct(Request $request)
    {

    }

    public function index(Request $request)
    {
        return view('cart/index');
    }
}
