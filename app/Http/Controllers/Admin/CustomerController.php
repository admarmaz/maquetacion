<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\DB\Customer;
use Debugbar;

class CustomerController extends Controller
{
    protected $agent;
    protected $locale;
    protected $locale_slug_seo;
    protected $image;
    protected $paginate;
    protected $customer;
    

    function __construct(Customer $customer, Agent $agent, Locale $locale, LocaleSlugSeo $locale_slug_seo, Image $image)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->image = $image;
        $this->customer = $customer;
    }

    public function index()
    {

        $view = View::make('admin.customers.index')
                ->with('customer', $this->customer)
                ->with('customers', $this->customer->where('active', 1)->paginate(4));

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

        $view = View::make('admin.customers.index')
        ->with('customer', $this->customer)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(CustomerRequest $request)
    {            
        $customer = $this->customer->updateOrCreate([
            'id' => request('id')],[    
            'name' => request('name'),
            'surname' => request('surname'),
            'direction' => request('direction'),
            'cp' => request('cp'),
            'location' => request('location'),
            'phone' => request('phone'),
            'country_id' => request('country_id'),
            'email' => request('email'),
            'active' => 1,
        ]);

        $view = View::make('admin.customers.index')
        ->with('customers', $this->customer->where('active', 1)->paginate(4))
        ->with('customer', $customer)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $customer->id,
        ]);
    }

    public function show(Customer $customer)
    {
        $view = View::make('admin.customers.index')
        ->with('customer', $customer)
        ->with('customers', $this->customer->where('active', 1)->paginate(4));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function destroy(Customer $customer)
    {
        $customer->active = 0;
        $customer->save();

        // $faq->delete();

        $view = View::make('admin.customers.index')
            ->with('customer', $this->customer)
            ->with('customers', $this->customer->where('active', 1)->paginate(4))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
            
        $query = $this->faq->query();

        if($filters != null){

            $query->when($filters->search, function ($q, $search) {

                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('customers.name', 'like', "%$search%");
                }   
            });

            $query->when($filters->created_at_from, function ($q, $created_at_from) {

                if($created_at_from == null){
                    return $q;
                }
                else {
                    $q->whereDate('customers.created_at', '>=', $created_at_from);
                }   
            });

            $query->when($filters->created_at_since, function ($q, $created_at_since) {

                if($created_at_since == null){
                    return $q;
                }
                else {
                    $q->whereDate('customers.created_at', '<=', $created_at_since);
                }   
            });

            $query->when($filters->order, function ($q, $order) use ($filters) {

                $q->orderBy($order, $filters->direction);
            });
        }

        $customers = $query->where('customers.active', 1)
                ->orderBy('customers.created_at', 'desc')
                ->paginate($this->paginate)
                ->appends(['filters' => json_encode($filters)]);   

        $view = View::make('admin.customers.index')
            ->with('customers', $customers)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }
}
