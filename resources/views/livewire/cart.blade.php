<div class="grid grid-cols-4 gap-4 mt-12">


    <div class="col-span-3 p-5 bg-white rounded-lg shadow">
        <table class="w-full ">
            <thead class="">
                <th class="text-left">Product</th>
                <th class="text-left ">Price</th>
                <th class="text-left ">Color</th>
                <th class="text-left ">Size</th>
                <th class="text-left ">Quantity</th>
                <th class="text-left ">Total</th>
                <th class="text-left"></th>
            </thead>
            <tbody class="">
                @foreach ($this->items as $item)
                    <tr >
                        <td>{{ $item->product->name }} </td>
                        <td>{{ $item->product->price }} </td>
                        <td>{{ $item->variant->color }}</td>
                        <td>{{ $item->variant->size }}</td>
                        </td>
                        <td class="flex items-center">
                            <button wire:click='decrement({{ $item->id }})' @disabled($item->quantity == 1)>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                            <div class="mx-2">
                                {{ $item->quantity }}
                            </div>
                            
                            <button wire:click='increment({{ $item->id }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </td>
                        <td>
                            {{$item->subtotal}}
                        </td>
                        <td>
                            <button wire:click='delete({{ $item->id }})'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            <tfoot class="mt-12">
                <tr>
                    <td colspan="5" class="font-medium text-right ">Total :</td>
                    <td class="font-bold text-red-700">{{$this->cart->total}}</td>
                        
                    
                </tr>
            </tfoot>
        </table>

    </div>
<div>
    <div class="col-span-1 p-5 bg-white rounded-lg shadow">
        @guest
            <p class="px-4">Please<a class="text-base text-blue-900 underline" href="{{route("register")}}"> Register</a>
                Or <a class="text-base text-blue-900 underline" href="{{route("login")}}"> Login</a> To Continue</p>
        @endguest
        @auth
        <div class="flex items-center justify-center m-auto">
            <x-button  wire:click='checkout'>Checkout</x-button>
        </div>
           
        @endauth
    </div>
</div>

</div>
