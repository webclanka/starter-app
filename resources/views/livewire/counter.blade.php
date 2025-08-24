<div class="text-center">
    <div class="text-6xl font-bold text-gray-800 mb-4">{{ $count }}</div>
    
    <div class="space-x-2 mb-6">
        <button wire:click="decrement" 
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
            -
        </button>
        
        <button wire:click="increment" 
                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
            +
        </button>
        
        <button wire:click="reset" 
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
            Reset
        </button>
    </div>
    
    <p class="text-gray-600">
        This is a simple Livewire counter component demonstrating real-time updates without page refreshes.
    </p>
</div>