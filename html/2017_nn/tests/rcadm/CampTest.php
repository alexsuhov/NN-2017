<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CampTest extends TestCase
{

    public function testCreate()
    {
        $this->visit(route('field.index'))
                ->see('cliptheme') // on Footer
                // nu pot verifica Pachet Curent pentru ca e Ajax
                ;                 
    }
    
    public function testCurrentPachet()
    {
        $this->json('GET', route('pachet.create') )
             ->seeJsonStructure([
                 'data'  => [
                    '*' => [
                        'cif', 'cod_produs' ,'id_document'
                        ]
                    ]
                 ])
                ;        
    }
}