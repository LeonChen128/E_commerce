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
                'description' => '',
                'category' => '3c',
                'price' => '15000',
            ],
            [
                'user_id' => 1,
                'title' => 'ASUS zenfone 5Z',
                'description' => '',
                'category' => '3c',
                'price' => '6000',
            ],
        ]);
    }
}