<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Role') }}
            </h2>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to Roles
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $role->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" name="slug" value="{{ old('slug', $role->slug) }}">
                                    <div class="form-text">Leave blank to auto-generate from name</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Users Count -->
                                <div class="mb-3">
                                    <label class="form-label">Users with this role</label>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info fs-6 me-2">{{ $role->users->count() }}</span>
                                        @if($role->users->count() > 0)
                                            <a href="{{ route('users.index', ['role_id' => $role->id]) }}" class="btn btn-sm btn-outline-primary">
                                                View Users
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Permissions -->
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto;">
                                        @foreach($availablePermissions as $permission)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       id="permission_{{ $loop->index }}" 
                                                       name="permissions[]" 
                                                       value="{{ $permission }}"
                                                       {{ in_array($permission, old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $loop->index }}">
                                                    {{ ucfirst(str_replace('.', ' ', $permission)) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permissions')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quick Select Buttons -->
                                <div class="mb-3">
                                    <label class="form-label">Quick Select:</label>
                                    <div class="btn-group d-block" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-2 mb-2" onclick="selectAllPermissions()">
                                            Select All
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary me-2 mb-2" onclick="selectNoPermissions()">
                                            Select None
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-info mb-2" onclick="selectUserPermissions()">
                                            User Permissions Only
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>Update Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const originalSlug = '{{ $role->slug }}';
            
            // Auto-generate slug from name if it matches the original or is empty
            document.getElementById('name').addEventListener('input', function() {
                const slugField = document.getElementById('slug');
                if (!slugField.value || slugField.value === originalSlug) {
                    const slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/^-|-$/g, '');
                    slugField.value = slug;
                }
            });
        });

        function selectAllPermissions() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = true;
            });
        }

        function selectNoPermissions() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        }

        function selectUserPermissions() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = checkbox.value.startsWith('users.');
            });
        }
    </script>
</x-app-layout>