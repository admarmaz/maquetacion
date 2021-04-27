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

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }
        else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

        $view = View::make('admin.faqs.index')
        ->with('faqs', $this->faq->where('active', 1)->paginate(4))
        ->with('faq', $faq)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
            'message' => $message,
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

        $query = $this->faq->query();

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

        $query->when($filters->order, function ($q, $order) use ($request) {

            $q->orderBy($order, $request->direction);
        });
        

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);

    }

}