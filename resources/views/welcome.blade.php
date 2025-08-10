<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Livewire Starter</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen bg-gray-100 flex items-center justify-center">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="text-center">
                    <div class="flex justify-center mb-8">
                        <x-application-logo class="w-16 h-16 fill-current text-gray-500" />
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Laravel Livewire Starter</h1>
                    <p class="text-lg text-gray-600 mb-8">A complete starter application with authentication, Livewire components, and modern tooling.</p>
                    
                    <div class="flex justify-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Log In
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">🔐 Authentication</h3>
                        <p class="text-gray-600">Complete authentication system with login, registration, and password reset functionality using Laravel Breeze.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">⚡ Livewire Components</h3>
                        <p class="text-gray-600">Reactive components for real-time updates, form handling, and interactive UI elements without writing JavaScript.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">🎨 Tailwind CSS</h3>
                        <p class="text-gray-600">Modern, responsive design with Tailwind CSS for rapid UI development and consistent styling.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">🔧 Modern Tooling</h3>
                        <p class="text-gray-600">Vite for fast builds, Alpine.js for interactivity, and hot module replacement for efficient development.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">🗄️ Database Ready</h3>
                        <p class="text-gray-600">Pre-configured migrations, models, and seeders with relationships and sample data for quick prototyping.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">🧪 Testing Setup</h3>
                        <p class="text-gray-600">PHPUnit configuration with feature and unit tests to ensure your application works reliably.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>