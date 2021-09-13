<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Exceptions\Error;
use \App\Model\Product;
use \App\Model\Order;
use \App\Model\OrderProduct;

class OrderController extends \App\Http\Controllers\Controller
{
    public function __construct(Request $request)
    {

    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if(!$user) { return response()->json(['message' => '請先登入帳號'], 400); }

        $params = $this->validate($request, [
            'products' => 'required|array',
        ]);

        $orderProducts = [];
        foreach ($params['products'] as $product) {
            if (!(isset($product['id']) && isset($product['count']))) {
                throw new Error('參數 products 陣列須有 『id』及『count』key');
            }
            $orderProducts[$product['id']] = $product;
        }

        $products = Product::whereIn('id', array_keys($orderProducts))->get()->keyBy('id');

        if ($products->count() != count($orderProducts)) {
            return response()->json(['message' => '找不到商品'], 400);
        }

        DB::transaction(function() use ($products, $orderProducts, $user) {
            $lastOrder = Order::where('no', ($no = 'PO-' . date('Ymd')))->orderByDesc('hash')->first();
            $hash = $lastOrder ? $lastOrder->hash + 1 : 1;
            $price = $products->map(function($product) use ($orderProducts, &$insertODs) {
                $orderProduct = $orderProducts[$product->id];

                if ($orderProduct['count'] > $product->total) {
                    throw new Error('選購商品 ' . $product->title . '，數量須小於 ' . $product->total);
                }

                // update product total
                $product->update(['total' => $product->total - $orderProduct['count']]);

                $insertODs = $insertODs ?? [];
                array_push($insertODs, [
                    'product_id' => $product->id,
                    'count' => $orderProduct['count']
                ]);

                return $product->price * $orderProduct['count'];
            })->sum();

            // insert order
            $order = Order::create([
                'user_id' => $user->id,
                'no' => $no,
                'hash' => $hash,
                'price' => $price
            ]);

            // inster order_product
            $insertODs = array_map(function($insertOD) use ($order) {
                $insertOD['order_id'] = $order->id;
                return $insertOD;
            }, $insertODs);
            OrderProduct::insert($insertODs);
        });

        return response()->json(['message' => '成功']);
    }
}
