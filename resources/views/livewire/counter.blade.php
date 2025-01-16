<div>
    <h1>{{ $count }}</h1>
 
    <button wire:click="increment">+</button>
 
    <button wire:click="decrement">-</button>


    <h1>{{ $message }}</h1>
    <input type="text" wire:model.live="message">
    <h1>{{ $message }}</h1>

</div>
