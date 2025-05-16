<div class="grid grid-cols-2 gap-10 py-12 mt-12">
    <div class="space-y-4" x-data="{ mainImage: '{{ asset('storage/' . $this->product->image->path) }}' }">
        <div class="p-5 bg-white rounded-lg shadow">
            <img x-bind:src="mainImage">
        </div>

        <div class="grid grid-cols-4 gap-4 ">
            @foreach ($this->product->images as $image)
                <div class="p-2 bg-white rounded shadow">
                    <img src="{{ asset('storage/' . $image->path) }}"
                        @click="mainImage = '{{ asset('storage/' . $image->path) }}'" alt="Image" >
                </div>
            @endforeach
        </div>
    </div>
    <div class="">
        <h1 class="mb-3 text-3xl font-medium">{{ $this->product->name }}</h1>
        <div class="mt-2 text-xl text-gray-700">{{ $this->product->price }}</div>
        <div class="mt-4">
            {{ $this->product->description }}
        </div> 
        <div class="mt-4 space-y-4">
            <select wire:model='variant' class="block w-full border-0 rounded-md py-1.5 pl-3 pr-10 text-gray-800">
                @foreach ($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->size }}/{{ $variant->color }} </option>
                @endforeach
            </select>
            @error('variant')
                <div class="mt-2 text-red-600">{{$message}}</div> 
            @enderror
            <x-button wire:click='addToCart'>Add To Cart</x-button>
        </div>
    </div>

</div>
