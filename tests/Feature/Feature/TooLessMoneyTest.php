<?php

namespace Tests\Feature\Feature;

use App\City;
use App\House;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TooLessMoneyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample_tooLessMoney404()
    {
        $response = $this->get('/api/houses/1?money=4');
        $response->assertStatus(404);
    }

    public function testExample_moneyIsEnough200()
    {
        $response = $this->get('/api/houses/1?money=9999999999999999999');
        $response->assertStatus(200);
    }

    public function testExample_randomHouse()
    {
        $house = House::inRandomOrder()->first();
        $response = $this->get('/api/houses/'.$house->id.'?money='.rand($house->price+1, $house->price*2));
        $response->assertStatus(200);
    }

    public function testExample_notFound()
    {
        $response = $this->get('/api/houses/A');
        $response->assertStatus(404);
    }

    public function testExample_missingData()
    {
        $response = $this->json('POST', '/api/houses', ['price' => rand(1,999999)]);

        $response->assertStatus(422);
    }

    public function testExample_correctData()
    {
        $city = City::inRandomOrder()->first();
        $response = $this->json('POST', '/api/houses', [
            'price' => rand(1, 999999),
            'title' => 'Testhaus',
            'description' => 'tst',
            'city_id' => $city->id
            ]
        );

        $response->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
