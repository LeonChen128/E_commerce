<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

// table model
use App\Model\User;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderProduct;

class Fake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:fake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init fake data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        // DB init
        Artisan::call('migrate:refresh');

        // User
        User::insert([
            [
                'name' => 'Leon',
                'account' => 'aaa',
                'password' => md5(1234),
                'address' => '台北市大安區',
                'phone' => '0958123123',
                // 'token' => md5('aaa' . config('app.user_token_hash') . '1234')
            ],
            [
                'name' => 'Ada',
                'account' => 'bbb',
                'password' => md5(1234),
                'address' => '新北市板橋區',
                'phone' => '0958121121',
            ]
        ]);

        // Product
        Product::insert([
            [
                'user_id' => 1,
                'title' => 'iphone 12',
                'description' => '全新，可面交',
                'category' => '3c',
                'price' => '15000',
                'img' => 'iphone.jpg',
                'total' => 4
            ],
            [
                'user_id' => 1,
                'title' => 'ASUS zenfone 5Z',
                'description' => '正常使用一年，全程使用犀牛盾，外觀無損',
                'category' => '3c',
                'price' => '4000',
                'img' => 'zenfone5z.jpg',
                'total' => 1
            ],
            [
                'user_id' => 1,
                'title' => 'Play Station 4 Pro',
                'description' => '購買日期 2020/5，可面交',
                'category' => '3c',
                'price' => '6000',
                'img' => 'ps4.jpg',
                'total' => 4
            ],
            [
                'user_id' => 1,
                'title' => 'Switch',
                'description' => '公司尾牙獎項，全新',
                'category' => '3c',
                'price' => '10000',
                'img' => 'switch.jpg',
                'total' => 2
            ],
            [
                'user_id' => 1,
                'title' => 'mac Pro 13"',
                'description' => '2020 機型，有 touch bar，不喜勿入',
                'category' => '3c',
                'price' => '23000',
                'img' => 'macbook_pro.jpg',
                'total' => 1
            ],
        ]);

        Order::insert([
            'user_id' => 2,
            'no' => 'PO-20210910',
            'hash' => 1,
            'price' => 21000
        ]);

        OrderProduct::insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'count' => 1
            ],
            [
                'order_id' => 1,
                'product_id' => 3,
                'count' => 1
            ]
        ]);
    }
}