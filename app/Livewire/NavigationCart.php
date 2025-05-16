<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Component;
use Livewire\Attributes\On;

class NavigationCart extends Component
{
    public $listeners = [
        "productAddedToCart" => '$refresh',
        "productRemovedFromCart" => '$refresh',
        "cartUpdated" => '$refresh',
    ];
    public function getCountProperty(){
      return  CartFactory::make()->items()->sum("quantity");
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}
