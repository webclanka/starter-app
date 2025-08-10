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
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <h2 class="card-text">{{ \App\Models\User::count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Active Users</h5>
                                    <h2 class="card-text">{{ \App\Models\User::where('status', 'active')->count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Roles</h5>
                                    <h2 class="card-text">{{ \App\Models\Role::count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">New Users Today</h5>
                                    <h2 class="card-text">{{ \App\Models\User::whereDate('created_at', today())->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Quick Actions</h4>
                            <div class="d-flex gap-3 mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-primary">
                                    <i class="bi bi-people me-1"></i>Manage Users
                                </a>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-shield me-1"></i>Manage Roles
                                </a>
                                <a href="{{ route('users.create') }}" class="btn btn-success">
                                    <i class="bi bi-person-plus me-1"></i>Add New User
                                </a>
                                <a href="{{ route('roles.create') }}" class="btn btn-info">
                                    <i class="bi bi-plus-circle me-1"></i>Create Role
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>