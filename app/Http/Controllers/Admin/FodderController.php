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
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;

use App\Models\DB\Fodder;
use App\Http\Requests\Admin\FodderRequest;

use Debugbar;

class FodderController extends Controller
{
    protected $fodder;
    protected $locale;
    protected $locale_slug_seo;
    protected $image;
    protected $paginate;
    
    function __construct(Agent $agent, Manager $manager, Fodder $fodder, Locale $locale, LocaleSlugSeo $locale_slug_seo, Image $image)
    {
        //$this->middleware('auth');
        $this->agent = $agent;
        $this->manager = $manager;
        $this->fodder = $fodder;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->image = $image;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 3;
        }

        $this->locale->setParent('fodders');
        $this->locale_slug_seo->setParent('fodders');
        $this->image->setEntity('fodders');

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
            'brand' => request('brand'),
            'active' => 1,
        ]);

        Debugbar::info($fodder);

        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request("seo"), $fodder->id, 'front_fodder');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $fodder->id);
        }

        if(request('images')){
            $images = $this->image->store(request('images'), $fodder->id);
        }

        if (request('id')){

            $message = \Lang::get('admin/faqs.fodder-update');
        }else{
            $message = \Lang::get('admin/faqs.fodder-create');
        }

        $view = View::make('admin.fodders.index')
        ->with('fodders', $this->fodder->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->with('fodder', $this->fodder)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
        ]);
    }

    public function edit(Fodder $fodder)
    {
        $locale = $this->locale->show($fodder->id);
        $seo = $this->locale_slug_seo->show($fodder->id);

        $view = View::make('admin.fodders.index')
        ->with('locale', $locale)
        ->with('seo', $seo)
        ->with('fodder', $fodder)
        ->with('fodders', $this->fodder->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate));        
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
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

    public function show(Fodder $fodder){

        $view = View::make('admin.fodders.index')
        ->with('fodder', $fodder)
        ->with('fodders', $this->fodder->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->fodder->query();

        if($filters != null){

            $query->when($filters->category_id, function ($q, $category_id) {

                if($category_id == 'all'){
                    return $q;
                }
                else{
                    return $q->where('category_id', $category_id);
                }
            });
    
            $query->when($filters->search, function ($q, $search) {
    
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_faqs.name', 'like', "%$search%");
                }   
            });
    
            $query->when($filters->created_at_from, function ($q, $created_at_from) {
    
                if($created_at_from == null){
                    return $q;
                }
                else {
                    $q->whereDate('t_faqs.created_at', '>=', $created_at_from);
                }   
            });
    
            $query->when($filters->created_at_since, function ($q, $created_at_since) {
    
                if($created_at_since == null){
                    return $q;
                }
                else {
                    $q->whereDate('t_faqs.created_at', '<=', $created_at_since);
                }   
            });
    
            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });
        }
    
        $fodder = $query->where('t_fodders.active', 1)
                ->orderBy('t_fodders.created_at', 'desc')
                ->paginate($this->paginate)
                ->appends(['filters' => json_encode($filters)]);   

        $view = View::make('admin.fodders.index')
            ->with('fodders', $fodders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }

}