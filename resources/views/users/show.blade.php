<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i>Edit User
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to Users
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <!-- Avatar -->
                            <div class="mb-4">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" 
                                     class="rounded-circle" width="150" height="150">
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="mb-3">
                                <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }} fs-6">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <!-- User Information -->
                            <h3 class="mb-4">{{ $user->name }}</h3>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Email:</strong><br>
                                        <span class="text-muted">{{ $user->email }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Role:</strong><br>
                                        @if($user->role)
                                            <span class="badge bg-secondary fs-6">{{ $user->role->name }}</span>
                                            @if($user->role->description)
                                                <div class="text-muted small mt-1">{{ $user->role->description }}</div>
                                            @endif
                                        @else
                                            <span class="text-muted">No role assigned</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong>Status:</strong><br>
                                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Email Verified:</strong><br>
                                        @if($user->email_verified_at)
                                            <span class="text-success">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Verified on {{ $user->email_verified_at->format('M j, Y') }}
                                            </span>
                                        @else
                                            <span class="text-warning">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                Not verified
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong>Member Since:</strong><br>
                                        <span class="text-muted">{{ $user->created_at->format('M j, Y') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Last Updated:</strong><br>
                                        <span class="text-muted">{{ $user->updated_at->format('M j, Y g:i A') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Permissions -->
                            @if($user->role && $user->role->permissions)
                                <div class="mt-4">
                                    <strong>Permissions:</strong>
                                    <div class="mt-2">
                                        @foreach($user->role->permissions as $permission)
                                            <span class="badge bg-light text-dark me-1 mb-1">{{ $permission }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2" 
                                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                    <i class="bi bi-trash me-1"></i>Delete User
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i>Edit User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>