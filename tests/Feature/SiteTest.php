<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;
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
        $faker = Faker\Factory::create();
        $randomYearDate = $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d');
        
        $response = $this->post('/birthdays', [
            'date' => $randomYearDate
        ]);

        $response->assertStatus(200);

        $response->assertSessionHasErrors([]);

       
    }

    /**
     * Can we submit an incorrect date?
     *
     * @return void
     */
    public function testCanNotSubmitAnIncorrectDate()
    {

        // TODO: Move faker into setUp
        $faker = Faker\Factory::create();

        $randomYearDate = $faker->dateTimeBetween('+1 years', '+2 years')->format('Y-m-d');
        
        $response = $this->post('/birthdays', [
            'date' => $randomYearDate
        ]);

        $response->assertStatus(400);

        $response->assertSessionHasErrors(['date']);
    }
}
