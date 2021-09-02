<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \App\Model\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct(Request $request)
    {
        $request->route('id') && $this->product = Product::findOrFail($request->route('id'));
    }

    public function index(Request $request)
    {
        return view('product/index');
    }

    public function info(Request $request)
    {
        $this->product->img = config('app.user_root') . $this->product->user_id . '/' . $this->product->img;
        $this->product->date = $this->product->updated_at->format('Y/m/d h:i:s');
        
        return view('product/info', [
            'product' => $this->product
        ]);
    }
}
