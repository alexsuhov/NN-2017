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
    protected $table = 'batch1';
    protected $primaryKey = 'ID_DOC';
    /**
     * Get the Entry for this scan
     */
    public function entry() 
    {
        return $this->hasOne('App\modules\DataEntry\Entry','id_entry','id_entry');
        return $this->belongsTo('App\modules\DataEntry\Entry' ,'id_entry');
    }

}
