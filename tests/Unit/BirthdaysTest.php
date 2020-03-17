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
        $birthdays = factory(Birthday::class, 2)->create()->map(function ($birthday) {
            return $birthday->only(['id', 'birthday', 'occurrences']);
        });

        $this->get(route('birthdays'))
            ->assertStatus(200)
            ->assertJson($birthdays->toArray())
            ->assertJsonStructure([
                '*' => ['id', 'birthday', 'occurrences'],
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
            ->assertJson($data);
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
            'birthday' => $selectedBirthday->birthday,
            'occurrences' => $selectedBirthday->occurrences
        ];

        $expectedData = [
            'birthday' => $selectedBirthday->birthday,
            'occurrences' => $selectedBirthday->occurrences + 1
        ];

        $this->post(route('birthdays.store'), $data)
            ->assertStatus(201)
            ->assertJson($expectedData);
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
        // $this->assertTrue(false);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testReturnedDatesMostRecentDateFirst()
    {
        // $this->assertTrue(false);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testDateFormatCorrect()
    {
        // The date should be displayed in the following format "15th January 2019"
        // $this->assertTrue(false);
    }
}
