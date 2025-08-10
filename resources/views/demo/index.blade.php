<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Livewire Demo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Counter Component -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Interactive Counter</h3>
                    @livewire('counter')
                </div>
            </div>
            
            <!-- Real-time Search Demo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Real-time Search</h3>
                    <p class="text-gray-600 mb-4">This demonstrates Livewire's live search capabilities. Search results update as you type.</p>
                    @livewire('search-demo')
                </div>
            </div>
            
            <!-- Form Validation Demo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Validation Demo</h3>
                    <p class="text-gray-600 mb-4">Real-time form validation without page refreshes.</p>
                    @livewire('form-demo')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>