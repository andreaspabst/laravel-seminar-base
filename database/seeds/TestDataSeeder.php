<?php

use App\Country;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Country::class, 5)->create()->each(function ($country) {
            for ($a = 0; $a < 10; $a++) {
                $city = $country->cities()->save(factory(App\City::class)->make());
                for ($i = 0; $i < 10; $i++) {
                    $city->houses()->save(factory(App\House::class)->make());
                }
            }
        });
    }
}
