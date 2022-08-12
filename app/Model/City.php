<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}