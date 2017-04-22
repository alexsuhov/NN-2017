<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'auth_roles';
    protected $primaryKey = 'id_role';
    
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User','auth_users_roles');
    }
}