<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $fillable = [];
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}