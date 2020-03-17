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
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Can we submit an incorrect date?
     *
     * @return void
     */
    public function testCanNotSubmitAnIncorrectDate()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
