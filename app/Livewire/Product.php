<?php

namespace App\Livewire;

use App\Actions\Webshop\AddProductVariantToCart;
use App\Models\Product as ModelsProduct;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class Product extends Component
{
    use InteractsWithBanner;
    public $productId;
    public $variant;

    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id']
    ];

    public function mount()
    {
        // variant = first varaint in product 
        //$this->product-> ***   زي ما ببعتها للبليد getProductProperty() انا جايبها من 
        //  يساوي اول واحد في البرودكت اول لما الوووود الصفحة احطله قيمة  $variant عاوز ال  
        $this->variant = $this->product->variants->first()->id;
    }
    public function getProductProperty()
    {
        return ModelsProduct::findOrFail($this->productId);
    }
    public function addToCart(AddProductVariantToCart $cart)
    {
        $this->validate();
        $cart->add(
            variantId: $this->variant
        );
        $this->banner("Your Product's Been Added to The Cart");
        $this->dispatch("productAddedToCart");
    }
    public function render()
    {
        return view('livewire.product');
    }
}
