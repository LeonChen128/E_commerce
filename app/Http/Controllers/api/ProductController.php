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
        $params = $this->validate($request, [
            'keyWord' => '',
            'offset' => ''
        ]);

        $build = Product::orderBy('updated_at', 'desc');

        $build = $params['keyWord'] ? $build->where('title', 'like', '%' . $params['keyWord'] . '%') : $build;
        
        $allCount = $build->count();
        
        $build = ($params['offset'] && is_numeric($params['offset'])) ? $build->skip($params['offset']) : $build;

        return response()->json([
            'products' => ($products = $build->take(10)->get()->map(function($product) {
                return [
                    'id' => $product->id,
                    'user_id' => $product->user_id,
                    'title' => $product->title,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'img' => config('app.user_root') . $product->user_id . '/' . $product->img,
                    'date' => $product->updated_at->format('U'),
                ];
            })),
            'offset' => $offect = ($params['offset'] ? ($params['offset'] + $products->count()) : $products->count()),
            'more' => ($offect >= $allCount) ? false : true
        ]);
    }
}
