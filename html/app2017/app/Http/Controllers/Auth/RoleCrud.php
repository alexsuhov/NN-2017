<?php

namespace App\Http\Controllers\Auth;

use App\Role as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use \Validator;


class RoleCrud extends Controller
{
    
    public $rules =             
        [    
            'role_name' => 'required|max:50|unique:auth_roles'
        ]; 
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {                    
        // HTTP
        return view("grid" , [ 'view' =>'roles']); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // HTTP
        return view("auth/role_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          
        if ( $this->validate($request, $this->rules ))
                return redirect(route('role.create'))
                        ->withErrors($validator)
                        ->withInput();
        
        
        $model = new Model ;
        $model->role_name       = $request->get('role_name');
        $model->has_perms       = json_encode( $request->get('perms') );
        $model->save();
        
        // redirect
        Session::flash('message', 'Successfully created nerd!');
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Model $role )
    {
        // show the view and pass the Model to it
        return view("auth.role_view" , $role );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $role )
    {
        // show the edit Form and pass the Model to it
        return view("auth.role_edit" , ['fields'=> $role ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $nerd)
    {
         $validator = Validator::make(Input::all(), $this->rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nerds/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $nerd = Nerd::find($id);
            $nerd->name       = Input::get('name');
            $nerd->email      = Input::get('email');
            $nerd->nerd_level = Input::get('nerd_level');
            $nerd->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('nerds');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $role )
    {
        // delete
//        $role = Model::find($id);
        $role->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the nerd!');
        return redirect(route('role.index'));
    }
}
