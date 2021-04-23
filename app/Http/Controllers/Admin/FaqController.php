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
                ->with('faqs', $this->faq->where('active', 1)->paginate(4));

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
        ->with('faqs', $this->faq->where('active', 1)->paginate(4))
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
        ->with('faqs', $this->faq->where('active', 1)->paginate(4));   
        
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
            ->with('faqs', $this->faq->where('active', 1)->paginate(4))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request){

        // Mediante esta solicitud pedimos filtrar a la base de datos según los criterios 
        // indicados. Se puede filtrar sobre los filtros aplicados.

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
                return $q -> where ('created_at', $created_at);
            }

        });

        $query->when(request('order'), function ($q, $order) {

            if($order == null){
                return $q;
            }
            else {
                $q = Faq::orderBy('title', 'asc')
                ->where('active', 1)->get();
                return $q;
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
        
        // Función que ordena Faqs de forma ascendente. Inconveniente, se encuentra 
        // fuera del filtro, por lo tanto, solo admite un criterio de orden.

        $faqs = Faq::orderBy('title', 'asc')
            ->where('active', 1)->paginate(4);

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