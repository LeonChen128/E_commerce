<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use \App\Model\Product;

class ProductController extends \App\Http\Controllers\Controller
{
    public function __construct(Request $request)
    {
        
    }

    public function index(Request $request)
    {
        $params = $request->validate([
            'page' => '',
            'limit' => '',
            'category' => ''
        ]);

        return response()->json(
            Product::orderBy('updated_at', 'desc')->get()->map(function($product) {
                return [
                    'id' => $product->id,
                    'user_id' => $product->user_id,
                    'title' => $product->title,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'img' => $product->img,
                    'date' => $product->updated_at->format('U'),
                ];
            })
        );
    }
}
