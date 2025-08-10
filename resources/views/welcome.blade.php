<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container-fluid">
            <div class="row min-vh-100">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center bg-light">
                    <div class="text-center">
                        <h1 class="display-4 mb-4">{{ config('app.name', 'Laravel Starter App') }}</h1>
                        <p class="lead mb-4">Welcome to your Laravel Livewire Starter Application</p>
                        
                        <div class="d-flex gap-3 justify-content-center">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                            <i class="bi bi-person-plus me-2"></i>Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>

                        <div class="mt-5">
                            <h5>Features Included:</h5>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                                            <h6 class="card-title mt-2">User Management</h6>
                                            <p class="card-text small">Complete CRUD for users with roles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-shield text-success" style="font-size: 2rem;"></i>
                                            <h6 class="card-title mt-2">Role-Based Access</h6>
                                            <p class="card-text small">Flexible permissions system</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-lightning text-warning" style="font-size: 2rem;"></i>
                                            <h6 class="card-title mt-2">Livewire Ready</h6>
                                            <p class="card-text small">Built for reactive components</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-phone text-info" style="font-size: 2rem;"></i>
                                            <h6 class="card-title mt-2">Responsive Design</h6>
                                            <p class="card-text small">Works on all devices</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>