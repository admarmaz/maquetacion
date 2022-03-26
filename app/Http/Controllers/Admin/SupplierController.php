<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DB\Supplier; 



class SupplierController extends Controller
{
    
    public function index()
    {
        $view = View::make('admin.suppliers.index')
        ->with('suppliers', Supplier::orderBy('created_at', 'desc')->paginate(10));
    
        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
                'sidebar' => $sections['sidebar'],
            ]);
        }
    
        return $view;
    }


    public function create()
    {
        $view = View::make('admin.suppliers.create')
        ->with('supplier', new Supplier());
    
        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
    
            return response()->json([
                'sections' => $sections['content'],
                'pagination' => $sections['pagination'],
            ]);
        }
    
        return $view;
    }
    
    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->fill($request->all());
        $supplier->save();
    
        return response()->json([
            'success' => true,
            'id' => $supplier->id,
            'message' => 'Supplier created successfully'
        ]);
    }
    
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
    
        $view = View::make('admin.suppliers.show')
        ->with('supplier', $supplier);
    
        if(request()->ajax()) {
            
            $sections = $view->renderSections(); 
    
            return response()->json([
                'sections' => $sections['content'],
                'pagination' => $sections['pagination'],
            ]);
        }
    
        return $view;


    }   

}