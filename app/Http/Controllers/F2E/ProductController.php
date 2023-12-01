<?php

namespace App\Http\Controllers\F2E;

use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends F2EController
{
    public function __construct(Request $request)
    {

    }

    public function index(Request $request)
    {
        return view('product.' . __FUNCTION__);
    }

    public function detail(Request $request)
    {
        return view('product.' . __FUNCTION__);
    }
}
