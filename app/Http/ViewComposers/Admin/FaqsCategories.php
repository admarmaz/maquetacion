<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\FaqCategory;

class FaqsCategories
{
    static $composed;

    public function __construct(FaqCategory $faqs_categories)
    {
        $this->faqs_categories = $faqs_categories;
    }

    public function compose(View $view)
    {

        //Si ya tenemos la variable composed con la base de datos asignada,
        // entonces, devolvemos la vista.
        if(static::$composed) 
        
        {
            return $view->with('faqs_categories', static::$composed);
        }

        //Si la variable no tiene la base de datos de categories, entonces llamamos a la base de datos
        // y asignamos el valor.

        static::$composed = $this->faqs_categories->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('faqs_categories', static::$composed);

    }
}