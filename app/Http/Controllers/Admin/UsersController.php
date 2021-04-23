<?php

namespace App\Http\Controllers\Admin;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsersRequest;
use App\Models\DB\User;
use Debugbar;

class UsersController extends Controller
{
    protected $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {

        $view = View::make('admin.users.index')
                ->with('user', $this->user)
                ->with('users', $this->user->where('active', 1)->paginate(2));

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

        $view = View::make('admin.users.index')
        ->with('user', $this->user)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(UsersRequest $request)
    {            
        if (request('password') !== null) {

            $user = User::updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'active' => 1,
            ]);
            
        }else{

            $user = User::updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'),
                'email' => request('email'),
                'active' => 1,
            ]);
        }

        $view = View::make('admin.users.index')
        ->with('users', $this->user->where('active', 1)->get())
        ->with('user', $user)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $user->id,
        ]);
    }

    public function show(User $user)
    {
        $view = View::make('admin.users.index')
        ->with('user', $user)
        ->with('users', $this->user->where('active', 1)->paginate(2));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
                
            ]); 
        }
        return $view;
    }

    public function destroy(User $user)
    {
        $user->active = 0;
        $user->save();

        $view = View::make('admin.users.index')
            ->with('user', $this->user)
            ->with('users', $this->user->where('active', 1)->paginate(2))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}
