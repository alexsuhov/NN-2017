<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;


class UserCrud extends Controller
{    
    public $rules =             
        [    
        //    'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:auth_users',
        ] ;
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) 
    {       
        // HTTP
        return view("grid" , ['view'=>"users"] );  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // HTTP
        return view("auth/user_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            $this->rules 
        ]);

        if ($validator->fails()) {
            return redirect(route('user.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $model = new User ;       
        $model->email       = $request->get('email');        
        $model->save();
        
        // to add Existing roles
        if($request->get('role'))
        $model->roles()->sync( $request->get('role') );
        
        // redirect
        Session::flash('message', 'Successfully created nerd!');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user )
    {
        if( ! empty($_GET['id_role'] ))
        {
            $user->roles()->detach( $_GET['id_role']);
        }
        return redirect(isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:route('user.index'));       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user )
    {       
        // show the edit form and pass the nerd
        return view("auth.user_edit" , ['fields'=> $user] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user )
    {          
        $validator = Validator::make($request->all(), [
            $this->rules 
        ]);
        
        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            //$nerd = $nerd->find($id);
            // store            
            $user->name       = $request->input('name');
            $user->email      = $request->input('email');     
            $user->save();
            // to add Existing roles
            $user->roles()->sync( $request->get('role')?$request->get('role') :[] );       
            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return redirect(route('user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        User::destroy( $id ) ;
        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return redirect(route('user.index'));
    }
    
    public function role ( Request $request )
    {
        User::find($request->input('user'))->roles()->toggle([$request->input('role')]);
        return redirect()->back();
    }
}
