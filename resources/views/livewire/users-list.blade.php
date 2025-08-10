<div class="space-y-6">
    <!-- Search and Filters -->
    <div class="flex flex-wrap gap-4 items-center">
        <div class="flex-1 min-w-64">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Search users..." 
                class="form-control"
            >
        </div>
        
        <div>
            <select wire:model.live="roleFilter" class="form-select">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <select wire:model.live="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>
            </select>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>
                            <input 
                                type="checkbox" 
                                wire:model.live="selectAll" 
                                class="form-check-input"
                            >
                        </th>
                        <th>Avatar</th>
                        <th>
                            <button 
                                wire:click="sortBy('name')" 
                                class="btn btn-link p-0 text-decoration-none text-dark"
                            >
                                Name
                                @if($sortField === 'name')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </button>
                        </th>
                        <th>
                            <button 
                                wire:click="sortBy('email')" 
                                class="btn btn-link p-0 text-decoration-none text-dark"
                            >
                                Email
                                @if($sortField === 'email')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </button>
                        </th>
                        <th>Role</th>
                        <th>
                            <button 
                                wire:click="sortBy('status')" 
                                class="btn btn-link p-0 text-decoration-none text-dark"
                            >
                                Status
                                @if($sortField === 'status')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </button>
                        </th>
                        <th>
                            <button 
                                wire:click="sortBy('created_at')" 
                                class="btn btn-link p-0 text-decoration-none text-dark"
                            >
                                Created
                                @if($sortField === 'created_at')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </button>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectedUsers" 
                                    value="{{ $user->id }}" 
                                    class="form-check-input"
                                >
                            </td>
                            <td>
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $user->role?->name ?? 'No Role' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('M j, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button 
                                            wire:click="deleteUser({{ $user->id }})" 
                                            wire:confirm="Are you sure you want to delete this user?"
                                            class="btn btn-outline-danger"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-3">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>