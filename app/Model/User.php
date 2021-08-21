<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}