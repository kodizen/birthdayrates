<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testCanSubmitADate()
    {
        $this->assertTrue(false);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testDoesNotStoreDuplicates()
    {

        // If the date has already been submitted, don't store it but update the 'occurrence' count.
        $this->assertTrue(false);
    }

    /**
     * A test to make sure a submitted date isn't in the future.
     *
     * @return void
     */
    public function testDateNotInFuture()
    {
        $this->assertTrue(false);
    }

    /**
     * A test to make sure a submitted date isn't over a year ago.
     *
     * @return void
     */
    public function testDateWithinYear()
    {
        $this->assertTrue(false);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testReturnedDatesMostRecentDateFirst()
    {
        $this->assertTrue(false);
    }

    /**
     * A test to make sure the returned date list shows the most recent date first.
     *
     * @return void
     */
    public function testDateFormatCorrect()
    {

        // The date should be displayed in the following format "15th January 2019"
        $this->assertTrue(false);
    }
}
