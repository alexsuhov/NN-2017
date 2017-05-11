<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCrudTest extends TestCase
{  
    //use WithoutMiddleware ;

    public function setUp() {
        parent::setUp(); // performs set up        
        
        Session::start(); // starts session, this is what handles csrf token part       
        $user = App\User::find(1);
        $this->be($user);
    }
    
    
        public function testDeleteMethod() {       

            //$this->visit(route('user.index'))
            //        ->see('bubu');           
            $this->call('DELETE', route('user.destroy' , 2) , ['_token' => csrf_token()]) ;   
            $this->notSeeInDatabase('auth_users', ['deleted_at' => null, 'id_user' => 2]);
            
            $this->visitRoute('user.index')
                    ->dontSee('bubu');  
        }
        
        public function testCreateMethod()
        {
            $this->visitRoute('user.create')
                    ->type('Taylor', 'name')
            //        ->check('terms')
            //        ->press('Register')
            //        ->seePageIs('/dashboard')
                    ;
        }
}