<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Batch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batch3';
    protected $primaryKey = 'ID_DOC';
    /**
     * Get the Entry for this scan
     */
    public function entry() 
    {
        return $this->hasOne('App\modules\DataEntry\Entry','id_entry','id_entry');
        return $this->belongsTo('App\modules\DataEntry\Entry' ,'id_entry');
    }
        
    /**
     * Get the Entry for this scan
     */
    public function poza()
    {
        return $this->belongsTo('App\modules\DataEntry\BatchPoza' , 'ID_DOC' , 'ID_DOC');
    }
    
    public function scopeMultiple($query)
    {
        //$query->whereIn('id_entry' , DB::raw('select id_entry from batch group by id_entry having count(id_entry) >1')->get());       
        return $query ;
    }
}
