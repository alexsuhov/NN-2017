<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScanTest extends TestCase
{

    public function testIndex()
    {
        $this->visit(route('scan.index'))
                ->see('cliptheme') // on Footer
                
                ;                 
    }
}