<div class="grid grid-cols-4 gap-4 mt-12">
    @foreach ($this->products as $product)
        <div class="relative p-4 text-center bg-white rounded-lg">
            <a href="{{ route('product', $product) }}" class="absolute inset-0 w-full h-full"></a>
            <img src="{{asset('storage/'.$product->image->path )  }}" class="rounded" alt="">
            <h2 class="mt-2 text-lg font-medium"> {{ $product->name }}</h2>
            <span class="text-sm text-gray-700">{{ $product->price }}</span>
        </div>
    @endforeach
</div>
