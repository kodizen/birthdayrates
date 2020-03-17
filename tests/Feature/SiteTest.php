<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;

class SiteTest extends TestCase
{
    protected $birthdays;
    public function setUp() :void
    {
        parent::setUp();

        $this->seed();

        // Should pull these from a proper factory class.
        $this->birthday = factory(\Birthday::class)->create([
            'date' => new DateTime(),
            'ocurrences' => 12
        ]);
    }
    /**
     * Can we see the homepage?
     *
     * @return void
     */
    public function testPageRenders()
    {
        $response = $this->call('GET', 'birthdays');

        $response->assertViewHas('birthdays', function($birthdays) {
            return $birthdays->contains($this->birthday);
        });
        $birthdays = $response->original->getData()['birthdays'];

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $birthdays);
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
