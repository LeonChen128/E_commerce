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
            [
                'user_id' => 1,
                'title' => '花紋抱枕',
                'description' => '這是花紋抱枕描述....',
                'category' => 'furniture',
                'price' => '1099',
                'img' => 'pillow.jpg',
                'total' => 12
            ],
            [
                'user_id' => 1,
                'title' => '超好吃櫻桃 (200g)',
                'description' => '這是超好吃櫻桃描述....',
                'category' => 'food',
                'price' => '399',
                'img' => 'cherry.jpg',
                'total' => 100
            ],
            [
                'user_id' => 1,
                'title' => '馬克杯 (附蓋子)',
                'description' => '這是馬克杯描述....',
                'category' => 'cup',
                'price' => '699',
                'img' => 'cup.jpg',
                'total' => 56
            ],
            [
                'user_id' => 1,
                'title' => '超好吃蘋果 (200g)',
                'description' => '這是超好吃蘋果描述....',
                'category' => 'food',
                'price' => '299',
                'img' => 'apple.jpg',
                'total' => 234
            ],
            [
                'user_id' => 1,
                'title' => '超好吃草莓 (200g)',
                'description' => '這是超好吃草莓描述....',
                'category' => 'food',
                'price' => '399',
                'img' => 'strawberry.jpg',
                'total' => 333
            ],
            [
                'user_id' => 1,
                'title' => '復古鬧鐘',
                'description' => '這是復古鬧鐘描述....',
                'category' => 'furniture',
                'price' => '799',
                'img' => 'clock.jpg',
                'total' => 432
            ],
            [
                'user_id' => 1,
                'title' => '歐洲風沙發',
                'description' => '這是歐洲風格沙發描述....',
                'category' => 'furniture',
                'price' => '17999',
                'img' => 'sofa.jpg',
                'total' => 23
            ],
            [
                'user_id' => 1,
                'title' => '床頭櫃',
                'description' => '這是床頭櫃描述....',
                'category' => 'furniture',
                'price' => '3999',
                'img' => 'cabinet.jpg',
                'total' => 23
            ],
            [
                'user_id' => 1,
                'title' => '麂皮貴妃椅',
                'description' => '這是麂皮貴妃椅描述....',
                'category' => 'furniture',
                'price' => '6999',
                'img' => 'chair.jpg',
                'total' => 134
            ],
            [
                'user_id' => 1,
                'title' => '木製垃圾桶',
                'description' => '這是木製垃圾桶描述....',
                'category' => 'furniture',
                'price' => '799',
                'img' => 'garbage_can.jpg',
                'total' => 222
            ],
            [
                'user_id' => 1,
                'title' => '吹風機',
                'description' => '這是吹風機描述....',
                'category' => 'furniture',
                'price' => '1532',
                'img' => 'hair_dryer.jpg',
                'total' => 222
            ],
            [
                'user_id' => 1,
                'title' => '機械式手錶',
                'description' => '這是機械式手錶描述....',
                'category' => 'fitting',
                'price' => '8999',
                'img' => 'watch.jpg',
                'total' => 321
            ],
            [
                'user_id' => 1,
                'title' => '領帶 (多色系)',
                'description' => '這是領帶描述....',
                'category' => 'fitting',
                'price' => '999',
                'img' => 'tie.jpg',
                'total' => 1421
            ],
            [
                'user_id' => 1,
                'title' => '復古眼鏡',
                'description' => '這是復古眼鏡描述....',
                'category' => 'fitting',
                'price' => '1324',
                'img' => 'glass.jpg',
                'total' => 1241
            ],
            [
                'user_id' => 1,
                'title' => '皮製保暖手套',
                'description' => '這是皮製保暖手套描述....',
                'category' => 'fitting',
                'price' => '1065',
                'img' => 'glove.jpg',
                'total' => 3212
            ],
            [
                'user_id' => 1,
                'title' => 'NIKE 棒球帽',
                'description' => '這是NIKE 棒球帽描述....',
                'category' => 'fitting',
                'price' => '999',
                'img' => 'cap.jpg',
                'total' => 123
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