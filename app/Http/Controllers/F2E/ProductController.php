<?php

namespace App\Http\Controllers\F2E;

use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends F2EController
{
    private $product;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $request->route('id') && $this->product = Product::findOrFail($request->route('id'));
    }

    public function index(Request $request)
    {
        return view('product.' . __FUNCTION__);
    }

    public function detail(Request $request)
    {
        $this->product->img = config('app.user_root') . '/' . $this->product->user_id . '/' . $this->product->img;
        $this->product->date = $this->product->updated_at->format('Y/m/d');

        return view('product/detail', [
            'product' => $this->product
        ]);
    }
}
