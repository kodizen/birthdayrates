<?php

namespace Tests\Unit;

use Faker\Generator as Faker;
use App\Birthday;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BirthdaysTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to make sure we can submit a birthday and we get the returned birthday.
     *
     * @return void
     */
    public function testCanViewBirthdays()
    {
        factory(Birthday::class, 2)->create()->map(function ($birthday) {
            return $birthday;
        });

        $this->get(route('birthdays'))
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'birthday', 'JPY', 'CAD', 'EUR', 'USD', 'GBP', 'base', 'occurrences', 'formatted_birthday'],
            ]);
    }

    /**
     * A test to make sure we can submit a birthday and we get the returned birthday.
     *
     * @return void
     */
    public function testCanSubmitADate()
    {
        $data = [
            'birthday' => \Carbon\Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-1 years', 'now')->getTimestamp())->toDateString()
        ];

        $this->post(route('birthdays.store'), $data)
            ->assertStatus(201)
            ->assertJson($data)
            ->assertJsonStructure(['formatted_birthday']);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testDoesNotStoreDuplicates()
    {
        // If the date has already been submitted, don't store it but update the 'occurrence' count.
        $birthdays = factory(Birthday::class, 2)->create();
        $selectedBirthday = $birthdays[0];

        $data = [
            'birthday' => $selectedBirthday->birthday
        ];

        $expectedData = [
            'birthday' => $selectedBirthday->birthday,
            'occurrences' => $selectedBirthday->occurrences + 1
        ];
       
        $response = $this->post(route('birthdays.store'), $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('birthdays', $expectedData);
    }

    /**
     * A test to make sure a submitted date isn't in the future.
     *
     * @return void
     */
    public function testDateNotInFuture()
    {
        $data = [
            'birthday' => \Carbon\Carbon::createFromTimeStamp($this->faker->dateTimeBetween('now', '+30 years')->getTimestamp())->toDateString()
        ];

        $this->post(route('birthdays.store'), $data)
            ->assertStatus(422)
            ->assertJsonStructure(['errors', 'request']);
    }

    /**
     * A test to make sure a submitted date isn't over a year ago.
     *
     * @return void
     */
    public function testDateWithinYear()
    {
        $data = [
            'birthday' => \Carbon\Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-10 years', '-1 years')->getTimestamp())->toDateString()
        ];

        $this->post(route('birthdays.store'), $data)
            ->assertStatus(422)
            ->assertJsonStructure(['errors', 'request']);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testReturnedDatesMostRecentDateFirst()
    {
        $birthdays = factory(Birthday::class, 50)->create()->map(function ($birthday) {
            return $birthday->only(['id', 'birthday']);
        });

        $dateArray = [];
        for ($index = 0; $index < count($birthdays); $index++) {
            $dateArray[] = $birthdays[$index]["birthday"];
        }

        // Get most recent date from generated birthdays.
        $max = max(array_map('strtotime', $dateArray));
        $content = $this->get(route('birthdays'))->decodeResponseJson();

        // Check the most recent date in our generated birthdays matches the first element of the json response we get at '/'
        $this->assertEquals($content[0]["birthday"], date('Y-m-d', $max));
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testDateFormatCorrect()
    {
        $birthday = factory(Birthday::class)->make([
            'birthday' => \Carbon\Carbon::parse('2020-01-15')
        ]);

        $this->assertEquals($birthday->getFormattedDate(), "15th January 2020");
    }
}
