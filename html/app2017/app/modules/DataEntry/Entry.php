<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public $timestamps = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entries';
    protected $primaryKey = 'id_entry';
    
    public function pachet()
    {
        return $this->belongsTo('App\modules\DataEntry\Pachet');
    }
    
    public function arhiva()
    {
        return $this->belongsTo('App\modules\DataEntry\EntryArhiva' ,'batch_id');
    }
    
    /**
     * Get the scanned files for the DataEntry record.
     */
    public function batch()
    {
        return $this->hasOne('App\modules\DataEntry\Batch')->orderBy('ID_DOC', 'desc');
    }
    
    public function document()
    {
        return $this->belongsTo('App\modules\DataEntry\Field','id_document');
    }
    
    public function produs()
    {
        return $this->belongsTo('App\modules\DataEntry\Field','cod_produs');
    }
}