<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\DB\Faq;

class FaqController extends Controller
{
    protected $faq;

    function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {

        $view = View::make('admin.faqs.index')
                ->with('faq', $this->faq)
                ->with('faqs', $this->faq->where('active', 1)->get());

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

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {            
        $faq = $this->faq->updateOrCreate([
            'id' => request('id')],[    
            'title' => request('title'),
            'description' => request('description'),
            'category_id' => request('category_id'),
            'active' => 1,
        ]);

        $view = View::make('admin.faqs.index')
        ->with('faqs', $this->faq->where('active', 1)->get())
        ->with('faq', $faq)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
        ]);
    }

    public function show(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        // $faq->delete();

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request){

        $query = $this->faq->query();

        $query->when(request('category_id'), function ($q, $category_id) {

            if($category_id == 'all'){
                return $q;
            }
            else {
                return $q->where('category_id', $category_id);
            }
        });

        $query->when(request('search'), function ($q, $search) {

            if($search == null){
                return $q;
            }
            else {
                return $q->where('title', 'like', "%$search%");
            }
        });

        $query->when(request('date_filter'), function ($q, $date_filter) {

            if($date_filter == null){
                return $q;
            }
        
            else{
                if($created_at >= 'from_date'){
                    if($created_at <= 'to_date'){
                        return $q->where(creadet);
                    }
                }
            }

        });

        $query->when(request('order'), function ($q, $order) {

            if($order == null){
                return $q;
            }
            else {
                return $q->where('title', 'like', "%$search%");
            }
        });
        
        
        $faqs = $query->where('active', 1)->get();

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs);

        if(request()->ajax()) {
            $sections = $view->renderSections(); 

            return response()->json([
                'table' => $sections['table'],
            ]); 
        }

    }

    public function order(){

        $faqs = Faq::orderBy('title', 'asc')
            ->where('active', 1)->get();

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs);

        if(request()->ajax()) {
            $sections = $view->renderSections(); 

            return response()->json([
                'table' => $sections['table'],
            ]); 
        }

        return $view;
    }

    //public function orderDesc(){}
}