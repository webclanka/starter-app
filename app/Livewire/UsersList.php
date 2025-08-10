<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    public $selectedUsers = [];
    public $selectAll = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->users->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        
        if ($user && $user->id !== auth()->id()) {
            $user->delete();
            session()->flash('success', 'User deleted successfully.');
        }
    }

    public function getUsersProperty()
    {
        $query = User::with('role');

        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->roleFilter) {
            $query->where('role_id', $this->roleFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->orderBy($this->sortField, $this->sortDirection)
                    ->paginate(10);
    }

    public function getRolesProperty()
    {
        return Role::all();
    }

    public function render()
    {
        return view('livewire.users-list', [
            'users' => $this->users,
            'roles' => $this->roles,
        ]);
    }
}