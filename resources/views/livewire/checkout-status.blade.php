<div class="max-w-xl p-5 mx-auto mt-12 bg-white rounded shadow ">
    @if ($this->order)
        Thank You for your order (#{{ $this->order->id }}) !!
    @else
        <p wire:poll>
            Waitong for payment confirmation . PLease Standby ...
        </p>
    @endif
</div>
