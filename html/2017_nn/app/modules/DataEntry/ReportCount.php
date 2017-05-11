<?php

namespace App\modules\DataEntry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReportCount extends Model
{
    public static function boot()
    {        
        static::creating(function ($report) {
            $report->user_id = Auth::user()->id_user;
        });
    }
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'report_counter';
}