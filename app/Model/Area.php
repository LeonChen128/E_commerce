<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}