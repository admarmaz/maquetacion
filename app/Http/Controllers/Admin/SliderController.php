<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;

class SliderController extends Controller
{
    protected $slider;

    function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {

        $view = View::make('admin.sliders.index')
                ->with('slider', $this->slider)
                ->with('sliders', $this->slider->where('active', 1)->paginate(4));

        if(request()->ajax()) {
            $sections = $view->renderSections(); 

            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    public function create()
    {

        $view = View::make('admin.sliders.index')
        ->with('slider', $this->slider)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(SliderRequest $request)
    {            
        $slider = $this->slider->updateOrCreate([
            'id' => request('id')],[    
            'name' => request('name'),
            'entity' => request('entity'),
            'active' => 1,
            'visible' => 0,
        ]);

        if(request('id')){
            $message = \Lang::get('admin/sliders.slider-update');
        }
        else{
            $message = \Lang::get('admin/sliders.slider-create');
        }

        $view = View::make('admin.sliders.index')
        ->with('sliders', $this->slider->where('active', 1)->paginate(4))
        ->with('slider', $slider)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $slider->id,
            'message' => $message,
        ]);

    }

    public function show(Slider $slider)
    {
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(4));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Slider $slider)
    {
        $slider->active = 0;
        $slider->save();

        $view = View::make('admin.sliders.index')
            ->with('slider', $this->slider)
            ->with('sliders', $this->slider->where('active', 1)->paginate(4))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter($filters = null){

        $query = $this->slider->query();

        $query->when($filters->search, function ($q, $search) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('t_sliders.name', 'like', "%$search%");
            }   
        });

        $query->when($filters->created_at_from, function ($q, $created_at_from) {

            if($created_at_from == null){
                return $q;
            }
            else {
                $q->whereDate('t_sliders.created_at', '>=', $created_at_from);
            }   
        });

        $query->when($filters->created_at_since, function ($q, $created_at_since) {

            if($created_at_since == null){
                return $q;
            }
            else {
                $q->whereDate('t_sliders.created_at', '<=', $created_at_since);
            }   
        });

        $query->when($filters->order, function ($q, $order) use ($request) {

            $q->orderBy($order, $request->direction);
        });

        if($this->agent->isMobile()){
            $sliders = $query->join('t_sliders', 't_sliders.', '=', 't_sliders.id')
            ->where('t_sliders.active', 1)->paginate(10);  
        }

        if($this->agent->isDesktop()){
            $sliders = $query->join('t_sliders', 't_sliders.category_id', '=', 't_sliders.id')
            ->where('t_sliders.active', 1)->paginate(6);  
        }

        $view = View::make('admin.sliders.index')
            ->with('sliders', $sliders)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);

    }

}