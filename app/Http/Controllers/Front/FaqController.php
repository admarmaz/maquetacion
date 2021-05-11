<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Http\Controllers\Controller;
use App\Models\DB\Faq;
use App;
use Debugbar;

class FaqController extends Controller
{
    protected $faq;
    protected $agent;
    protected $locale;

    function __construct(Faq $faq, Locale $locale, Agent $agent)
    {
        $this->agent = $agent;
        $this->faq = $faq;
        $this->locale = $locale;
    }

    public function index()
    {

        $faqs = $this->faq->where('active', 1)->get();

        $faqs = $faqs->each(function($faq) {  
            
            $faq['locale'] = $faq->locale->pluck('value','tag');
            
            return $faq;
        });

        Debugbar::info($faqs);


        $view = View::make('front.pages.faqs.index')
                ->with('faqs', $faqs );

        return $view;
    }

}
