<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

// table model
use App\Model\User;

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
        Artisan::call('migrate:refresh');
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        User::insert([
            'name' => 'super administrator',
            'account' => 'aaa',
            'password' => md5(1234),
            'token' => md5('aaa' . config('app.user_token_hash') . '1234')
        ]);
    }
}