<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends _APIController
{
    /**
     * 取得商品列表
     * 
     * @api {get} /api/product 取得商品列表
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $params = $this->validatorTransfer($request, [
            'key_word|關鍵字' => 'string|max:190',
            'offset|位移' => 'integer|min:0'
        ]);

        $products = Product::when(isset($params['key_word']), function ($query) use ($params, &$likes) {
            $likes = ['title', 'like', '%' . $params['key_word'] . '%'];
            $query->where(...$likes);
        })->when(isset($params['offset']), function ($query) use ($params) {
            $query->skip($params['offset']);
        })->take(10)->orderByDesc('updated_at')->get();

        $matchCount = (isset($likes) ? Product::where(...$likes) : Product::query())->count();

        return response()->json([
            'products' => ProductResource::collection($products)->resolve(),
            'offset' => $offect = ($params['offset'] ?? 0) + $products->count(),
            'more' => $offect < $matchCount,
        ]);
    }
}
