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
    private $order;

    public function __construct(Request $request)
    {
        $request->route('id') && $this->order = Order::findOrFail($request->route('id'));
    }

    public function create(Request $request)
    {
        if(!$user = Auth::user()) { return response()->json(['message' => '請先登入帳號'], 400); }

        $params = $this->validate($request, [ 'products' => 'required|array' ]);

        if (!$orderProducts = Order::verifyOrderProducts($params['products'])) {
            return response()->json(['message' => '成立訂單的商品參數有誤'], 400);
        }

        $products = Product::whereIn('id', array_keys($orderProducts))->get()->keyBy('id');

        if ($products->count() != count($orderProducts)) {
            return response()->json(['message' => '查無此商品 ID'], 400);
        }

        DB::transaction(function() use ($products, $orderProducts, $user) {
            $lastOrder = Order::where('no', ($no = 'PO-' . date('Ymd')))->orderByDesc('hash')->first();
            $hash = $lastOrder ? $lastOrder->hash + 1 : 1;
            $price = $products->map(function($product) use ($orderProducts, &$insertODs) {
                $orderProduct = $orderProducts[$product->id];

                if (!$product->total) {
                    throw new Error('選購商品 ' . $product->title . '，已無庫存');
                }

                if ($orderProduct['count'] > $product->total) {
                    throw new Error('選購商品 ' . $product->title . '，庫存只剩 ' . $product->total);
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

    public function cancel(Request $request)
    {
        if (in_array($this->order->status, [Order::STATUS_CANCEL, Order::STATUS_FINISH])) {
            return response()->json(['message' => '該訂單無法取消'], 400);
        }

        DB::transaction(function() {
            $this->order->update(['status' => Order::STATUS_CANCEL]);

            $orderProducts = $this->order->orderProducts->groupBy('product_id')->map(function($group) {
                $group->first()->count = $group->sum('count');
                return $group->first();
            });

            Product::whereIn('id', $orderProducts->keys()->toArray())->get()->map(function($product) use ($orderProducts) {
                $product->update(['total' => $product->total + $orderProducts[$product->id]->count]);
            });
        });
        
        return response()->json(['message' => '成功']);
    }
}
