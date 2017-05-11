<?php
    
return [
    
    'perm' => [
        'use_force', // config to Unlimit Memory & Time
        'roles',
        'users',
        'user_to_role',
        'fields',
        'pachete',
        'scans',
        'data_entry',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Permision Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'data_entry'
    ],
    
];