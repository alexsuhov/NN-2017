<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;

class BatchPoza extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batch3_poze';
            
    /**
     * Get the scanned files for the DataEntry record.
     */
    public function batch()
    {
        return $this->hasOne('App\modules\DataEntry\Batch');
    }
}
