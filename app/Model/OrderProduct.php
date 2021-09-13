<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = ['updated_at', 'created_at'];
}