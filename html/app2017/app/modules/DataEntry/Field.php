<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_field';
        
    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {               
        return $query->where('tip', $type);       
    }
    
    /**
     * The Documents that belong to the Option.
     */
    public function fields()
    {
        return $this->belongsToMany( 'App\modules\DataEntry\Field' ,'fields_field','parent_id','child_id');
    }    
    
    /**
     * The Tabs that have this Option.
     */
    public function fieldsUp()
    {
        return $this->belongsToMany( 'App\modules\DataEntry\Field' ,'fields_field','child_id','parent_id');
    }   
}