<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Models\Product as DBProduct;

class Product
{
    protected $rel_parent;

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
    

    public function store($product, $id)
    {  

        foreach ($product as $rel_anchor => $value){

            $rel_anchor = str_replace(['-', '_'], ".", $rel_anchor); 
            $explode_rel_anchor = explode('.', $rel_anchor);
            array_pop($explode_rel_anchor); 
            $tag = implode(".", $explode_rel_anchor); 

            $product[] = $this->product->updateOrCreate([
                    'id' => $id],[
                    'rel_parent' => $this->rel_parent,
                    'rel_anchor' => $rel_anchor,
                    'tag' => $tag,
                    'value' => $value,
            ]);
        }

        return $product;
    }

    public function show($key)
    {
        return DBProduct::getValues($this->rel_parent, $key)->pluck('value','rel_anchor')->all();   
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
    

