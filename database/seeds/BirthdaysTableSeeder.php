<?php

use Illuminate\Database\Seeder;
use App\Birthday;
class BirthdaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $birthdays = factory(Birthday::class, 10)->create();
    }
}
