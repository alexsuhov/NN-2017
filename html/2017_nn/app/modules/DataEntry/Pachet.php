<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pachet extends Model
{
        
    public static function boot()
    {        
        static::creating(function ($pachet) {
            $pachet->user_id = Auth::user()->id_user;
        });
    }
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'arhiva_pachet';
    protected $primaryKey = 'id_pachet';
        
    /**
     * Get the documents (entries) for pachet.
     */
    public function entry()
    {
        return $this->hasMany('App\modules\DataEntry\Entry');
    }
    
    /*
     * unde sunt arhivate documentele din acest pachet
     * care este cutia/batch-ul din arhiva fizica 
     */
    public function arhiva()
    {         
        //return $this->entry->arhiva();
        return $this->belongsToMany('App\modules\DataEntry\EntryArhiva', 'arhiva_entries_P3' ,'pachet_id' , 'batch_id');
    
        
    }
    
    /*
     * daca a fost scanat dat nu e arhivat inca
     */
    public function scan()
    {
        return $this->hasManyThrough(
            'App\modules\DataEntry\Batch', 'App\modules\DataEntry\Entry',
            'pachet_id' , 'id_entry'
        );
    }
    
    /**
     * Get the User that created/open this Pachet
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
