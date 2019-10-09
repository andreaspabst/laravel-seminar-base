<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use App\Events\ProductBoughtEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_product_can_be_created()
    {
        Log::info('**** TEST: test_product_can_be_created');
        $product = factory(Product::class)->create();

        $this->assertDatabaseHas('products', [
            'id'    => 1,
            'title' => $product->title,
            'price' => $product->price,
            'stock' => $product->stock
        ]);
    }

    /**
     * @test
     * Das Produkt kann gekauft werden und der Warenbestand verringert sich
     */
    public function test_product_can_be_bought()
    {
        Log::info('**** TEST: test_product_can_be_bought');
        $product = factory(Product::class)->create(['stock' => 16]);

        $response = $this->get('/api/products/1/buy/15');
        $response->assertStatus(200);

        $result = Product::find(1);
        $this->assertEquals($result->stock, 1);
    }

    /**
     * @test
     * Das Produkt kann gekauft werden und der Warenbestand verringert sich
     */
    public function test_product_can_be_bought_and_fake_mail()
    {
        Log::stack(['slack','daily'])->info('**** TEST: test_product_can_be_bought_and_fake_mail');
        $product = factory(Product::class)->create(['stock' => 16]);

        Log::info('Now there should follow an email sent log entry:');
        Mail::fake();
        Mail::assertNothingSent();

        $response = $this->get('/api/products/1/buy/15');

        Log::info('Nahh? Where is the email log entry?');
        $response->assertStatus(200);

        $result = Product::find(1);
        $this->assertEquals($result->stock, 1);
    }

    /**
     * @test
     * Das Produkt kann gekauft werden und der Warenbestand verringert sich
     */
    public function test_product_can_be_bought_without_any_event()
    {
        Log::info('**** TEST: test_product_can_be_bought_without_any_event');
        $product = factory(Product::class)->create(['stock' => 16]);

        Log::info('Now there should follow an event:');
        Event::fake();

        $response = $this->get('/api/products/1/buy/15');

        Log::info('Huh?! Where is it?');
        $response->assertStatus(200);

        $result = Product::find(1);
        $this->assertEquals($result->stock, 1);
    }

    /**
     * @test
     * Das Produkt in der URL existiert nicht
     */
    public function test_not_existing_product_cant_be_bought()
    {
        Log::info('**** TEST: test_not_existing_product_cant_be_bought');
        $product = factory(Product::class)->create();

        $response = $this->get('/api/products/42/buy/15');
        $response->assertStatus(404);
    }

    /**
     * @test
     * Bei einem leeren Warenbestand kann das Produkt nicht gekauft werden
     */
    public function test_product_with_empty_stock_cant_be_bought()
    {
        Log::info('**** TEST: test_product_with_empty_stock_cant_be_bought');
        $product = factory(Product::class)->create(['stock' => 0]);

        $response = $this->get('/api/products/1/buy/1');
        $response->assertStatus(403);
    }

    /**
     * @test
     * Es wurde keine Anzahl in der URL übergeben, obwohl mindestens ein Produkt gekauft werden muss
     */
    public function test_product_cant_be_bought_without_quantity()
    {
        Log::info('**** TEST: test_product_cant_be_bought_without_quantity');
        $product = factory(Product::class)->create(['stock' => 15]);

        $response = $this->get('/api/products/1/buy/0');
        $response->assertStatus(403);
    }
}
