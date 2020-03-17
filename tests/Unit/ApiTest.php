<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A test to check the fixer.io api is up and running.
     *
     * @return void
     */
    public function testCanConnectToFixerApi()
    {
        // Setup Guzzle
        $client = new \GuzzleHttp\Client();

        // Actually call the api with a key from our phpunit.xml
        $url ='http://data.fixer.io/api/latest?access_key=' . env('FIXER_API_KEY');
        
        $res = $client->get($url);

        $this->assertEquals($res->getStatusCode(), 200);
    }

    /**
     * A test to mock the fixer.io api with an error and allow us to handle it gracefully.
     *
     * @return void
     */
    public function testFallsOverGracefully()
    {
                    //fail gracefully and return a simple error message.


    }

}
