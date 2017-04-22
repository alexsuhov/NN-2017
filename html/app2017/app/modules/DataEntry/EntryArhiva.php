<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;

class EntryArhiva extends Model
{
    public $timestamps = false;
    protected $fillable = ['batch_name', 'skp_id'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entries_arhiva';
    protected $primaryKey = 'id_batch';
    
        
    /**
     * Get the documents (entries) for Batch.
     */
    public function entry()
    {
        return $this->hasMany('App\modules\DataEntry\Entry' , 'batch_id');
    }
}