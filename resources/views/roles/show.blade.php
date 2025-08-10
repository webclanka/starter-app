<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Role Details') }}
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i>Edit Role
                </a>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to Roles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Role Information -->
                            <h3 class="mb-4">{{ $role->name }}</h3>
                            
                            <div class="mb-3">
                                <strong>Slug:</strong><br>
                                <code>{{ $role->slug }}</code>
                            </div>

                            @if($role->description)
                                <div class="mb-3">
                                    <strong>Description:</strong><br>
                                    <span class="text-muted">{{ $role->description }}</span>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>Users with this role:</strong><br>
                                <span class="badge bg-info fs-6">{{ $role->users->count() }}</span>
                                @if($role->users->count() > 0)
                                    <a href="{{ route('users.index', ['role_id' => $role->id]) }}" class="btn btn-sm btn-outline-primary ms-2">
                                        View Users
                                    </a>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Created:</strong><br>
                                <span class="text-muted">{{ $role->created_at->format('M j, Y g:i A') }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Last Updated:</strong><br>
                                <span class="text-muted">{{ $role->updated_at->format('M j, Y g:i A') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Permissions -->
                            <div class="mb-4">
                                <strong>Permissions:</strong>
                                @if($role->permissions && count($role->permissions) > 0)
                                    <div class="mt-2">
                                        @foreach($role->permissions as $permission)
                                            <span class="badge bg-light text-dark me-1 mb-1">
                                                {{ ucfirst(str_replace('.', ' ', $permission)) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <span class="text-muted">No permissions assigned</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Users List -->
                    @if($role->users->count() > 0)
                        <div class="mt-5">
                            <h4>Users with this role</h4>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role->users->take(10) as $user)
                                            <tr>
                                                <td>
                                                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle" width="30" height="30">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($user->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $user->created_at->format('M j, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($role->users->count() > 10)
                                    <div class="text-center">
                                        <a href="{{ route('users.index', ['role_id' => $role->id]) }}" class="btn btn-outline-primary">
                                            View all {{ $role->users->count() }} users
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        @if($role->users->count() == 0)
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2" 
                                        onclick="return confirm('Are you sure you want to delete this role? This action cannot be undone.')">
                                    <i class="bi bi-trash me-1"></i>Delete Role
                                </button>
                            </form>
                        @else
                            <button class="btn btn-danger me-2" disabled title="Cannot delete role with assigned users">
                                <i class="bi bi-trash me-1"></i>Delete Role
                            </button>
                        @endif
                        
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i>Edit Role
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>