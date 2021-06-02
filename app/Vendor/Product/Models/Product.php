<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Debugbar;

class Product extends Model
{
    protected $table = 't_products';
    protected $guarded = [];

    public function fodders()
    {
        return $this->hasMany(Fodder::class, 'fodders_id');
    }

}