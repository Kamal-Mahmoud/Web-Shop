<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AddProductVariantToCart
{

    public function add($variantId, $quantity = 1, $cart = null)
    {
        //    $cart = match (Auth::guest()) {
        //     true => Cart::firstOrCreate(['session_id' => session()->getId()]),
        //     false => Auth::user()->cart ?: Auth::user()->cart()->create()
        // };


        ($cart ?: CartFactory::make())->items()->firstOrCreate( // checks for all the arguments to be present before it finds a match.
            ['product_variant_id' => $variantId],
            ['quantity' => 0]
        )->increment('quantity', $quantity);
    }
}
