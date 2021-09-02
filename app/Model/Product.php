<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = ['updated_at', 'created_at'];
}