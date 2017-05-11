<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PachetTest extends TestCase
{

    public function testIndex()
    {
        $this->visit(route('pachet.index'))
                ->see('cliptheme') // on Footer
                
                ;                 
    }
}