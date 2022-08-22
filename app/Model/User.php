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

    public function jsonFormat()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'account' => $this->account,
            'address' => $this->address,
            'phone' => $this->phone,
            'head' => config('app.user_root') . ($this->head ? $this->id . '/' . $this->head : 'default.jpg'),
        ];
    }
}