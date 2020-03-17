<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{

    /**
     * Can we see the homepage?
     *
     * @return void
     */
    public function testPageRenders()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    /**
     * Can we submit a date?
     *
     * @return void
     */
    public function testCanSubmitACorrectDate()
    {
        //  $this->visit('/')
        //  ->type('15/01/2019', 'date')
        //  ->press('Submit')
        //  ->see('<List of dates here>')
        //  ->seePageIs('/');
    }

    /**
     * Can we submit an incorrect date?
     *
     * @return void
     */
    public function testCanNotSubmitAnIncorrectDate()
    {
         //  $this->visit('/')
        //  ->type('15/01/2015', 'date')
        //  ->press('Submit')
        //  ->see('<Error Message>')
        //  ->seePageIs('/');
    }
}
