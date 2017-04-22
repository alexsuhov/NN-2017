<?php

namespace App\Http\Controllers\RCADM;

use App\modules\DataEntry\Field;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CampuriApi extends Controller
{
    public function index(Request $request)
    {       
        return view("RCADM/field_index" , ['rows'=> new Field] );           
    } 
    
    /*
     * nu am Create pentru ca form-ul este in list (table) 
     */
    public function store(Request $request)
    {        
        $field  = new Field;      
                    
        $field->tip = $request->input('tip') ;
        $field->descriere = $request->input('descriere') ;
        $field->cod = $request->input('cod') ;
                    
        $field->save();            
        $field->fields()->sync( $request->input('field')?$request->get('field') :[] );
            
        return redirect(route('field.index'))->with('message', 'Successfully created nerd!');        
    }    

    public function edit ( Field $field )
    {
        return view("RCADM/field_index" , ['rows'=>  new Field , 'editField'=>$field] ); 
    }
    
    /*
     * @todo - update la descriere & cod daca nu au fost utilizate 
     */
    public function update(Request $request, Field $field )
    { 
        if($field->tip == 'doc')
            $parent = Field::OfType('produs')->find($request->get('field'));
        elseif ($field->tip == 'tab') 
            $child = Field::OfType('produs')->find($request->input('field'));            
        elseif ($field->tip == 'produs') 
        {
            $parent = Field::OfType('tab')->find($request->get('field'));           
            $child = Field::OfType('doc')->find($request->input('field'));            
        }
        
            $field->fields()  ->sync( !empty($child)?$child:[] );     
            $field->fieldsUp()->sync( !empty($parent)?$parent:[] ); 

        $field->descriere = $request->input('descriere') ;
        $field->cod = $request->input('cod') ;
        $field->save(); 
        
            return redirect(route('field.edit', $field));        
    }
    
    public function destroy(Field $field)
    {        
        $field->delete();
        return redirect(route('field.index'))->with('message', 'Successfully deleted the nerd!');
    }
}