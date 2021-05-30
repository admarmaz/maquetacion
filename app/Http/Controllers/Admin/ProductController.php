<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Vendor\Product\Model\Product;

use Debugbar;

class ProductController extends Controller
{
    protected $agent;
    
    function __construct(Agent $agent, Manager $manager, )
    {
        //$this->middleware('auth');
        $this->agent = $agent;
        $this->manager = $manager;
       

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
    }

    public function index()
    {
        $seos = $this->seo
                ->select('key')
                ->groupBy('key')
                ->paginate($this->paginate);  

        $view = View::make('admin.seo.index')->with('seos', $seos);

        if(request()->ajax()) {

            $sections = $view->renderSections(); 

            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

}