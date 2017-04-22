<?php

namespace App\Http\Controllers\RCADM;

use Validator;

use App\modules\DataEntry\Entry ;
use App\modules\DataEntry\Field ; // used to create Form
use App\modules\DataEntry\Pachet ; // used to create Form
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class EntryApi extends Controller
{
    
    public function create(Request $request)
    {       
        $pachet=Pachet::
                where("is_etichete_generated" , "=" , -1)->
                findOrNew($request->session()->get('pachet_curent' , NULL) )->
                entry()->
                orderBy('id_entry', 'desc')->
                paginate(50);          
        return view("RCADM/entry_create" , ['field' => Field::class , 'pachet'=> $pachet]);
    }
    
    public function store(Request $request)
    {             
        $validator = Validator::make($request->all(), [    
            'cif' => 'required|numeric|max:8388607',
            'id_aplicatie' => 'numeric|max:8388607',
            'produs' => 'required',
            'doc' => 'required',       
        ]);
        

        if ($validator->fails() ) {
            return redirect(route('rcadm.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
// pachet curent find or create       
        $pachet = Pachet::
                where(['is_etichete_generated' =>-1]) ->
                findOrNew( $request->session()->get('pachet_curent') );        
        $pachet->save();
        
        $request->session()->put('pachet_curent', $pachet->id_pachet);        
        
// store new documents        
        foreach ($request->get('doc') as $doc)
        {            
            $entry = new Entry ;
            $entry->pachet_id = $request->session()->get('pachet_curent');
            $entry->id_document   = $doc ;
            $entry->cif           = $request->get('cif');
            $entry->produs= $request->get('produs');
            !empty($request->get('data_semnare'))?
                $entry->data_semnare    = $request->get('data_semnare'):"0000-00-00" ;   
            !empty($request->get('id_aplicatie'))?
                $entry->id_aplicatie    = $request->get('id_aplicatie'):"" ;    
            $entry->save();           
        }       
         return redirect(route('rcadm.create'))->with('message', 'Successfully created nerd!');
    }   
    
    function destroy( $id , Request $request)
    {
        $entry = Pachet::
                where("is_etichete_generated" , "=" , -1)->
                findOrNew($request->session()->get('pachet_curent'))->
                entry()->
                find($id);

        if($entry)          $entry->delete();
        
        return redirect(route('rcadm.create'))->with('message', 'Successfully deleted nerd!');
    }
}