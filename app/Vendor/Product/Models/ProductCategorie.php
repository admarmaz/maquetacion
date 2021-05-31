<?php

namespace App\Vendor\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Debugbar;

class ProductCategorie extends Model
{
    protected $table = 't_product_categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function items()
    {
        return $this ->hasMany(Item::class, 'item_id');
    }

}