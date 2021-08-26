<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}