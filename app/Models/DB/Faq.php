<?php

namespace App\Models\DB;

class Faq extends DBModel
{

    protected $table = 't_faqs';
    protected $with = ['category']; // mediante esta linea, realizamos una llamada a la base de datos para 
                                    // que aparte de t_faqs, traiga la base de datos faqs category,
                                    // Se debe revisar que es más óptimo, no siempre sale rentable.

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }

}