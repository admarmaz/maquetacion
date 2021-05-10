<?php

namespace App\Vendor\Locale;

use App\Vendor\Locale\Models\Locale as DBLocale;
use App\Vendor\Locale\Models\LocaleLanguage;
use Debugbar;

class Locale
{
    protected $rel_parent;
    protected $language;

    public function __construct(DBLocale $locale)
    {
        $this->locale = $locale;
    }

    public function setParent($rel_parent)
    {
        $this->rel_parent = $rel_parent;
    }

    public function getParent()
    {
        return $this->rel_parent; 
    }

    public function store($locale, $key)
    {
        foreach($locale as $rel_anchor => $value)
        { 
        
            $rel_anchor_explode = explode(".", $rel_anchor);
            $language = end($rel_anchor_explode);
            array_pop($rel_anchor_explode); 
            $tag = implode(".", $rel_anchor_explode);

            $locale[] = $this->locale->updateOrCreate([
                'key' => $key,
                'rel_parent' => $this->rel_parent,
                'rel_anchor' => $rel_anchor],[
                'rel_parent' => $this->rel_parent,
                'rel_anchor' => $rel_anchor,
                'language' => $language,
                'tag' => $tag,
                'value' => $value,
            ]);

            Debugbar::info($locale);
            
        }

        return $locate;
            

    }

    public function show($key)
    {
        return DBLocale::getValues($this->rel_parent, $key)->pluck('value','rel_anchor')->all();   
    }

}

