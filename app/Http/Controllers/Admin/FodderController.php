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
use App\Vendor\Product\Models\Fodder;
use App\Http\Requests\Admin\FodderRequest;

use Debugbar;

class FodderController extends Controller
{
    protected $fodder;
    
    function __construct(Agent $agent, Manager $manager, Fodder $fodder)
    {
        //$this->middleware('auth');
        $this->agent = $agent;
        $this->manager = $manager;
        $this->fodder = $fodder;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }

    }

    public function index()
    {
        
        $view = View::make('admin.fodders.index')
        ->with('fodder', $this->fodder)
        ->with('fodders', $this->fodder->where('active', 1)
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

    public function store(FodderRequest $request)
    {            

        $fodder = $this->fodder->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
        ]);


        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request("seo"), $fodder->id, 'front_faq');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $fodder->id);
        }

        if(request('images')){
            $images = $this->image->store(request('images'), $fodder->id);
        }

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

        $view = View::make('admin.fodder.index')
        ->with('faqs', $this->fodder->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->with('faq', $this->fodder)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
        ]);
    }


    public function destroy(Fodder $fodder)
    {
        $fodder->active = 0;
        $fodder->save();

        $message = \Lang::get('admin/items.item-delete');

        $view = View::make('admin.fodders.index')
        ->with('fodder', $this->fodder)
        ->with('fodder', $this->fodder->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message
        ]);
    }

    public function create()
    {
        $view = View::make('admin.fodders.index')
        ->with('fodder', $this->fodder)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

}