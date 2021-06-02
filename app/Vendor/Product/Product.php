<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;
use Debugbar;

class Product
{
    protected $rel_parent;
    protected $language;

    function __construct(DBProduct $product)
    {
        $this->product = $product;
    }

    public function setParent($rel_parent)
    {
        $this->rel_parent = $rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function store($product, $key)
    {  

        Debugbar::info($product['unit_cost']);

        $product = $this->product->updateOrCreate([
            'key' => $key,
            'rel_parent' => $this->rel_parent],[
            'unit_cost' => $product['unit_cost'],
            'discount' => $product['discount'],
            'sale_price' => $product['sale_price'],
            'VAT' => $product['VAT'],
    ]);
    
        return $product;
    }

    public function show($key)
    {
        return DBProduct::getValues($this->rel_parent, $key)->pluck('unit_cost','VAT')->all();   
    }

    public function delete($key)
    {
        if (DBProduct::getValues($this->rel_parent, $key)->count() > 0) {

            DBProduct::getValues($this->rel_parent, $key)->delete();   
        }
    }

    public function getIdByLanguage($key){ 
        return DBProduct::getIdByLanguage($this->rel_parent, $this->language, $key)->pluck('value','tag')->all();
    }

    public function getAllByLanguage(){ 

        $items = DBProduct::getAllByLanguage($this->rel_parent, $this->language)->get()->groupBy('key');

        $items =  $items->map(function ($item) {
            return $item->pluck('value','tag');
        });

        return $items;
    }
}
    

