<?php

namespace App\Http\Controllers\RCADM;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    function sync()
    {
        
        $users = DB::connection('mysql_old')->select('SELECT * FROM `auth_users`');

        
        
        dump($users);
        
        
        //$users = DB::statement("mysqldump --user=alex -palex123 --host=192.168.1.100 aplicatie_dis --tables pachete batch batch_poze 'b_flux 3_batch' b_flux3_batch_poze campuri_noi tab_check users date_xls  | mysql --user=root -psanuintri bubu");
    
        
        // DB::statement( require getcwd() ."/../database/migrations/From240_arhiva.sql" );
        
        //$row = 0 ;
        //while ($row  < 17000000 ) {            
        $query = file_get_contents ( getcwd() ."/../database/migrations/From240_1.sql" ) ;
        
        //var_dump($query);
        
            DB::statement( "$query");
        //    $row = $row + 1000000;
        //}
    }
    
    
    function create_pachete()
    {
        
    }
            
    function force()
    {
        
    }
}