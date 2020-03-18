<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Birthday;
use Faker\Generator as Faker;

$factory->define(Birthday::class, function (Faker $faker) {
    $currencyArray = array('GBP', 'USD', 'EUR', 'CAD', 'JPY');
    $randCurrency = $currencyArray[array_rand($currencyArray)];
    
    return [
        'birthday' => \Carbon\Carbon::createFromTimeStamp($faker->dateTimeBetween('-1 years', 'now')->getTimestamp())->toDateString(),
        'GBP' => ($randCurrency == 'GBP' ? 1 : $faker->randomFloat(4, 0, 2)),
        'USD' => ($randCurrency == 'USD' ? 1 : $faker->randomFloat(4, 0, 2)),
        'EUR' => ($randCurrency == 'EUR' ? 1 : $faker->randomFloat(4, 0, 2)),
        'CAD' => ($randCurrency == 'CAD' ? 1 : $faker->randomFloat(4, 0, 2)),
        'JPY' => ($randCurrency == 'JPY' ? 1 : $faker->randomFloat(4, 0, 2)),
        'base' => $randCurrency,
        'occurrences' => rand()
    ];
});
