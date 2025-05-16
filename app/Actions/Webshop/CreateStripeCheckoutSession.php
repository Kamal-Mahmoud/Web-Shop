<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CreateStripeCheckoutSession
{

    public function crateFormCart(Cart $cart)
    {
        $items = $this->formatCartItems($cart->items);

        // Flatten the items for Stripe's expected format
        $flattenedItems = [];
        foreach ($items as $item) {
            $flattenedItems[] = $item;
        }

        Log::info('Stripe Checkout Payload: ', $flattenedItems);
        // checkout method // in Stripe built-in
        return $cart->user
            ->allowPromotionCodes()
            ->checkout(
                $flattenedItems,
                [
                    'customer_update' => [
                        'shipping' => "auto",

                    ],
                    "shipping_address_collection" => [
                        "allowed_countries" => ['US', 'EG', 'NL', 'SA']
                    ],
                    'success_url' => route("checkout-status") . '?session_id={CHECKOUT_SESSION_ID}',
                    "cancel_url" => route("cart"),
                    'metadata' => [
                        'user_id' => $cart->user->id,
                        'cart_id' => $cart->id
                    ]
                ]
            );
    }
    private function formatCartItems(Collection $items)
    {
        return $items->loadMissing('product', 'variant')->map(function (CartItem $item) {
            return [
                "price_data" => [
                    'currency' => 'USD',
                    'unit_amount' => (int) $item->product->price->getAmount(),
                    "product_data" => [
                        'name' => $item->product->name,
                        'description' => "Size:{$item->variant->size} - Color :{$item->variant->color} ",
                        'metadata' => [
                            'product_id' => $item->product->id,
                            'product_variant_id' => $item->product_variant_id,
                        ]
                    ]
                ],
                "quantity" => (int) $item->quantity,
            ];
        })->toArray(); // Ensure to convert the collection to an array here
    }
}
