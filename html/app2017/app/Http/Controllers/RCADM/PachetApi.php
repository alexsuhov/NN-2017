<?php

namespace App\Http\Controllers\RCADM;

use App\modules\DataEntry\Pachet; 
use App\Http\Controllers\Controller;

class PachetApi extends Controller
{

    public function index()
    {            
        return view("grid" , ["view"=>"pachet"]); 
    }

    /*
     * etichete 2D
     */
    public function show(Pachet $pachet)
    {
        $pachet->is_etichete_generated = 1 ;
        $pachet->save();
        return view("RCADM.etichete2D" , ['rows'=> $pachet->entry()->with('produs')->with('document')->get()] );
    }
    /*
     * forced closed
     */
    public function edit(Pachet $pachet )
    {
        $pachet->is_etichete_generated = 0 ;
        $pachet->save();
        return redirect()->back()->with('message', 'Successfully updated the nerd!');
    }
}
