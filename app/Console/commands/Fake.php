<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

// table model
use App\Model\User;
use App\Model\Product;

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
            'name' => 'super administrator',
            'account' => 'aaa',
            'password' => md5(1234),
            'token' => md5('aaa' . config('app.user_token_hash') . '1234')
        ]);

        // Product
        Product::insert([
            [
                'user_id' => 1,
                'title' => 'iphone 12',
                'description' => '全新，可面交',
                'category' => '3c',
                'price' => '15000',
                'img' => 'iphone.jpg'
            ],
            [
                'user_id' => 1,
                'title' => 'ASUS zenfone 5Z',
                'description' => '正常使用一年，全程使用犀牛盾，外觀無損',
                'category' => '3c',
                'price' => '4000',
                'img' => 'zenfone5z.jpg'
            ],
            [
                'user_id' => 1,
                'title' => 'Play Station 4 Pro',
                'description' => '購買日期 2020/5，可面交',
                'category' => '3c',
                'price' => '6000',
                'img' => 'ps4.jpg'
            ],
            [
                'user_id' => 1,
                'title' => 'Switch',
                'description' => '公司尾牙獎項，全新',
                'category' => '3c',
                'price' => '10000',
                'img' => 'switch.jpg'
            ],
            [
                'user_id' => 1,
                'title' => 'mac Pro 13"',
                'description' => '2020 機型，有 touch bar，不喜勿入',
                'category' => '3c',
                'price' => '23000',
                'img' => 'macbook_pro.jpg'
            ],
        ]);
    }
}