<div>
    <h1 class="text-4xl font-bold text-center my-10">This is a Full-Page Livewire Component!</h1>
    
    <p class="text-center text-xl">Hello from Livewire 3 - Full Page Test</p>
    
    <div class="text-center mt-8">
        <button wire:click="sayHello" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Click Me
        </button>
        
        @if($message)
            <p class="mt-4 text-green-600 font-semibold">{{ $message }}</p>
        @endif
    </div>
</div>
