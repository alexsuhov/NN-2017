<?php

namespace App\Http\Controllers\RCADM;

use App\modules\DataEntry\Batch ;
use App\modules\DataEntry\EntryArhiva ;
use App\modules\DataEntry\ReportCount ;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class ScanApi extends Controller
{
    /*
     * Muta Batch-ul in arhiva
     */
    public function show( $batch_name )
    {
        // Has been SCANNED before  - CRASH
        Batch::
                where('Batch' , $batch_name)->
                has('entry.arhiva')->
                first();
 //---------------------------------------------------------        
        $batch = Batch::
                    where('Batch', $batch_name)->get();           
                    
        $arhiva = new EntryArhiva();            
        $arhiva->batch_name = $batch_name;                 
        $arhiva->skp_serie =    is_int ( $serie = substr($batch->first()->cutie, 0 , 1)) ? "T" : $serie;            
        $arhiva->skp_id = (int) is_int ( $serie ) ? substr($batch->first()->cutie, 0 , 9) : ltrim( $batch->first()->cutie , $serie ) ;       
        $arhiva->save();
        
       // dd($arhiva);
          
        //DB::transaction(function () {
        foreach ($batch as $row)
        {    
            $entry = $row->entry()->get() ;
            if(!isset($entry[0]))
                return redirect()->back()->with('message', $row->id_entry . ' Nu a fost introdus! CIF:' . $row->cif ." DOC:" .$row->doc ." Produs:" .$row->cod_produs);
            
            $entry[0]->arhiva()->associate( $arhiva ) ;
            $entry[0]->PATH = $row->poza->PATH  ;
            $entry[0]->save();     
            $row->delete();
        }
        
        return redirect()->back()->with('message', $batch_name.' A fost mutat!');
    }
    
    /*
     * Doar Cutia poate fi modificata
     */
    public function update(Request $request, $batch)
    {
        $batch = EntryArhiva::find($batch);
        $batch->skp_id = $request->input('skp_id');
        $batch->save();
        
        return redirect()->back()->with('message',  $request->input('skp_id') . ' Cutia a fost modificata');
    }
    
    /*
     *  diverse rapoarte in format CSV
     */
    
    public function export($batch ,  $template)
    {
        $batch = EntryArhiva::find($batch);         
        if($template == 'csv')     
        {
            $count = new ReportCount;
            $count->save();        
            return view("csv.trimite" , ['rows'=> $batch , 'count'=>$count->id] );     
        }
        
        return view("csv.scan" , ['rows'=> $batch] );        
    }

    

    public function arhiveaza(Request $request, $batch)
    {
        return "arhiveaza" . $batch;
    }
}