<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = ['updated_at', 'created_at'];

    const STATUS_WAIT = 'wait';
    const STATUS_ING = 'ing';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FINISH = 'finish';
    const STATUS = [
        self::STATUS_WAIT => '等待中',
        self::STATUS_ING => '處理中',
        self::STATUS_CANCEL => '取消',
        self::STATUS_FINISH => '完成',
    ];

    public function orderProducts()
    {
        return $this->hasMany('App\Model\OrderProduct');
    }

    // 成立訂單時，商品參數的驗證
    public static function verifyOrderProducts(array $products)
    {
        $orderProducts = [];
        foreach ($products as $product) {
            if (!isset($product['id'], $product['count'])) {
                return false;
            }
            $orderProducts[$product['id']] = [
                'id' => $product['id'],
                'count' => $product['count'] + ($orderProducts[$product['id']]['count'] ?? 0)
            ];
        }
        return $orderProducts;
    }
}