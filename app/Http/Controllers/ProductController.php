<?php

namespace App\Http\Controllers;

use App\Events\ProductBoughtEvent;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function buy_product($id, $quantity)
    {
        $product = Product::findOrFail($id);

        if ($quantity <= 0) {
            return response()->json([
                'error'     => true,
                'message'   => 'Es muss mindestens ein Produkt bestellt werden.'
            ], 403);
        } else if ($quantity > $product->stock) {
            return response()->json([
                'error'     => true,
                'message' => 'Es sind leider nicht genügend Produkte auf Lager um diese Bestellung durchzuführen.'
            ], 403);
        }

        $product->stock -= $quantity;
        $product->save();

        event(new ProductBoughtEvent($product));

        return response()->json([
            'error'     => false,
            'message' => 'Produkte erfolgreich gekauft.'
        ], 200);
    }
}
