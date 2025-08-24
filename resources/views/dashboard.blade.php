<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="mb-4">You're logged in to the Laravel Livewire Starter Application. This dashboard showcases various features and components.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-900">Posts Management</h4>
                            <p class="text-blue-700 text-sm mt-1">Create, edit, and manage your posts with Livewire components.</p>
                            <a href="{{ route('posts.index') }}" class="inline-block mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View Posts →
                            </a>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-900">Profile Settings</h4>
                            <p class="text-green-700 text-sm mt-1">Update your profile information and password.</p>
                            <a href="{{ route('profile.edit') }}" class="inline-block mt-2 text-green-600 hover:text-green-800 text-sm font-medium">
                                Edit Profile →
                            </a>
                        </div>
                        
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-900">Livewire Demo</h4>
                            <p class="text-purple-700 text-sm mt-1">Interactive components demonstrating real-time features.</p>
                            <a href="{{ route('demo.index') }}" class="inline-block mt-2 text-purple-600 hover:text-purple-800 text-sm font-medium">
                                View Demo →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Posts -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Posts</h3>
                    @livewire('recent-posts')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>