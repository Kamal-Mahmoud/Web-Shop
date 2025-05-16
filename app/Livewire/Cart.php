<?php

namespace App\Livewire;

use App\Actions\Webshop\CreateStripeCheckoutSession;
use App\Factories\CartFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\Exception\InvalidRequestException;

class Cart extends Component
{
    public $cart;
    public function checkout(CreateStripeCheckoutSession $checkoutSession)
    {
        try {
            return $checkoutSession->crateFormCart($this->cart);
        }
         catch (InvalidRequestException $e) {
            Log::error('Stripe Error: ' . $e->getMessage());
        }
    }
    public function getCartProperty()
    {
        return CartFactory::make()->loadMissing(['items', 'items.product', 'items.variant']);
    }
    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function refreshCart()
    {
        $this->cart = $this->getCartProperty(); // Refresh the cart data
    }


    public function mount()
    {
        $this->refreshCart();
    }

    public function getItemsProperty()
    {
        return $this->cart->items; //     getCartProperty() انا جايبها '$this->cart-'   من 
    }
    public function delete($itemId)
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch("productRemovedFromCart");
        $this->dispatch('cartUpdated');
    }
    public function increment($itemId)
    {
        $item = $this->cart->items()->find($itemId);
        if ($item) {
            $item->increment("quantity");
            $this->refreshCart(); // Refresh the cart data
            $this->dispatch('cartUpdated');
        }
    }
    public function decrement($itemId)
    {
        $item = $this->cart->items()->find($itemId);
        if ($item && $item->quantity > 1) {
            $item->decrement("quantity");
            $this->refreshCart(); // Refresh the cart data
            $this->dispatch('cartUpdated');
        }
    }
    public function render()
    {
        return view('livewire.cart');
    }
}


    // public function increment($itemId)
    // {
    //     $this->cart->items()->find($itemId)?->increment("quantity");
    //     $this->refreshCart();
    // }