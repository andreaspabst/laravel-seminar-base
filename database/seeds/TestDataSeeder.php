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
        // factory(App\Country::class, 50)->create();

        factory(App\Country::class, 5)->create()->each(function ($country) {
            for ($i = 0; $i < 10; $i++) {
                $country->cities()->save(factory(App\City::class)->make());
            }
        });

        // $de = Country::create(['code' => 'DE', 'name' => 'Deutschland']);
        // Country::create(['code' => 'AT', 'name' => 'Österreich']);
        // Country::create(['code' => 'FR', 'name' => 'Frankreich']);
        // Country::create(['code' => 'DK', 'name' => 'Dänemark']);

        // $nbg = $de->cities()->create(['code' => 'NBG', 'name' => 'Nürnberg']);
        // $ber = $de->cities()->create(['code' => 'BER', 'name' => 'Berlin']);
        // $ffm = $de->cities()->create(['code' => 'FFM', 'name' => 'Frankfurt']);

        // $h1 = $nbg->houses()->create(['title' => 'Testhaus 1', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
        // $h2 = $ber->houses()->create(['title' => 'Testhaus 2', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
        // $h3 = $ffm->houses()->create(['title' => 'Testhaus 3', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
        // $h4 = $nbg->houses()->create(['title' => 'Testhaus 4', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
        // $h5 = $ber->houses()->create(['title' => 'Testhaus 5', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
        // $h6 = $ffm->houses()->create(['title' => 'Testhaus 6', 'price' => '123.456', 'description' => 'Lorem Ipsum']);
    }
}
