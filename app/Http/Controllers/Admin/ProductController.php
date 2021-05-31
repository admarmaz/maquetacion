<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Vendor\Locale\Manager;
use Jenssegers\Agent\Agent;
use App\Vendor\Product\Models\Product;

use Debugbar;

class ProductController extends Controller
{
    protected $product;
    
    function __construct(Agent $agent, Manager $manager, Product $product)
    {
        //$this->middleware('auth');
        $this->agent = $agent;
        $this->manager = $manager;
        $this->product = $product;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
    }

    public function index()
    {
        
        $view = View::make('admin.products.index')->with('seos', $seos)
        ->with('product', $this->product)
        ->with('faqs', $this->product->where('active', 1)
        ->orderBy('created_at', 'desc')
        ->paginate($this->paginate));

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