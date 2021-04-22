<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqCategoryRequest;
use App\Models\DB\FaqCategory;

class FaqCategoryController extends Controller
{
    protected $faq_category;

    function __construct(FaqCategory $faq_category)
    {
        $this->faq_category = $faq_category;
    }

    public function index()
    {

        $view = View::make('admin.faqs_category.index')
                ->with('faq_category', $this->faq_category)
                ->with('faq_categories', $this->faq_category->where('active', 1)->get())
                ->with('faq_categories', FaqCategory::paginate(4));

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

        $view = View::make('admin.faqs_category.index')
        ->with('category', $this->faq_category)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqCategoryRequest $request)
    {            
        $faq_category = $this->faq_category->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
        ]);

        $view = View::make('admin.faqs_category.index')
        ->with('faq_categories', $this->faq_category->where('active', 1)->get())
        ->with('faq_category', $faq_category)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);   
    }

    public function show(FaqCategory $faq_category)
    {
        $view = View::make('admin.faqs_category.index')
        ->with('faq_category', $faq_category)
        ->with('faq_categories', $this->faq_category->where('active', 1)->get());
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(FaqCategory $faq_category)
    {
        $faq_category->active = 0;
        $faq_category->save();
        
        $view = View::make('admin.faqs_category.index')
            ->with('faq_category', $this->faq_category)
            ->with('faq_categories', $this->faq_category->where('active', 1)->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}
