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
            'keyWord' => 'string|nullable|max:190',
            'offset' => 'integer|min:0'
        ]);

        $build = isset($params['keyWord']) && $params['keyWord']
            ? Product::where('title', 'like', '%' . $params['keyWord'] . '%') : new Product();
        
        $filterCount = $build->count();
        
        $build = isset($params['offset']) && $params['offset']
            ? $build->skip($params['offset']) : $build;

        return response()->json([
            'products' => $products = $build->take(10)->orderByDesc('updated_at')->get()->map(function($product) {
                return [
                    'id' => $product->id,
                    'user_id' => $product->user_id,
                    'title' => $product->title,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'img' => config('app.user_root') . '/' . $product->user_id . '/' . $product->img,
                    'date' => $product->updated_at->format('Y/m/d h:i:s'),
                ];
            }),
            'offset' => $offect = isset($params['offset']) && $params['offset'] ? ($params['offset'] + $products->count()) : $products->count(),
            'more' => ($offect >= $filterCount) ? false : true
        ]);
    }
}
