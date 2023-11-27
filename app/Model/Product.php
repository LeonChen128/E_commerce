<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = ['updated_at', 'created_at'];

    public function getImageUrl()
    {
        return config('app.user_root') . '/' . $this->user_id . '/' . $this->img;
    }

    public function orderProducts()
    {
        return $this->hasMany('App\Model\OrderProduct');
    }
}