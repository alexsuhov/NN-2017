<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DataEntryTest extends TestCase
{
    
    public function setUp() {
        parent::setUp(); // performs set up        
        
        Session::start(); // starts session, this is what handles csrf token part       
        $user = App\User::find(1);
        $this->be($user);
    }
        
    
    /**
     * vezi poti insera mai multe documente cu acelas CIF & cod produs
     *
     * @return void
     */
    public function testCreate()
    {
        $this->visit(route('rcadm.create'))
                ->see('cliptheme') // on Footer
                
                ;                 
    }
    
    /**
     * vezi poti sterge datele
     *
     * @return void
     */
    public function testDelete()
    {
        //$this->visit('/')
        //     ->see('imaging');       
    }   

}