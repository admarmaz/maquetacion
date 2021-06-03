<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Models\DB\Fodder;
use Debugbar;

class FodderController extends Controller
{
    protected $agent;
    protected $fodder;
    protected $locale_slug_seo;

    function __construct(Agent $agent, Fodder $fodder, LocaleSlugSeo $locale_slug_seo)
    {
        $this->agent = $agent;
        $this->fodder = $fodder;
        $this->locale_slug_seo = $locale_slug_seo;

        $this->locale_slug_seo->setLanguage(app()->getLocale()); 
        $this->locale_slug_seo->setParent('fodders');      
    }

    public function index()
    {        
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());

        if($this->agent->isDesktop()){

            $fodders = $this->fodder
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }
        
        elseif($this->agent->isMobile()){
            $fodders = $this->fodder
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->get();
        }

        $fodders = $fodders->each(function($fodder){  
            
            $fodder['locale'] = $fodder->locale->pluck('value','tag');
            
            return $fodder;
        });

        $view = View::make('front.pages.fodders.index')
                ->with('fodders', $fodders) 
                ->with('seo', $seo );
        
        return $view;
    }

    public function show($slug)
    {      
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if(isset($seo->key)){

            if($this->agent->isDesktop()){
                $fodder = $this->fodder
                    ->with('image_featured_desktop')
                    ->with('image_grid_desktop')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }
            
            elseif($this->agent->isMobile()){
                $fodder = $this->fodder
                    ->with('image_featured_mobile')
                    ->with('image_grid_mobile')
                    ->where('active', 1)
                    ->where('visible', 1)
                    ->find($seo->key);
            }

            $fodder['locale'] = $fodder->locale->pluck('value','tag');

            $view = View::make('front.pages.fodders.single')->with('fodder', $fodder);

            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
    }
}
