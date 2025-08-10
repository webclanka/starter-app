<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Role filtering
        if ($request->filled('role_id')) {
            $query->withRole($request->role_id);
        }

        // Status filtering
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        $allowedSortFields = ['name', 'email', 'created_at', 'status'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        }

        $users = $query->paginate(10)->withQueryString();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:active,inactive,suspended'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
                        ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('role');
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:active,inactive,suspended'],
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                           ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully.');
    }

    /**
     * Handle bulk actions.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:delete,activate,deactivate,suspend,assign_role'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['exists:users,id'],
            'role_id' => ['required_if:action,assign_role', 'nullable', 'exists:roles,id'],
        ]);

        $users = User::whereIn('id', $validated['user_ids']);

        // Prevent bulk action on own account
        $currentUserId = auth()->id();
        if (in_array($currentUserId, $validated['user_ids'])) {
            return redirect()->route('users.index')
                           ->with('error', 'You cannot perform bulk actions on your own account.');
        }

        switch ($validated['action']) {
            case 'delete':
                $users->delete();
                $message = 'Selected users deleted successfully.';
                break;
            case 'activate':
                $users->update(['status' => 'active']);
                $message = 'Selected users activated successfully.';
                break;
            case 'deactivate':
                $users->update(['status' => 'inactive']);
                $message = 'Selected users deactivated successfully.';
                break;
            case 'suspend':
                $users->update(['status' => 'suspended']);
                $message = 'Selected users suspended successfully.';
                break;
            case 'assign_role':
                $users->update(['role_id' => $validated['role_id']]);
                $message = 'Role assigned to selected users successfully.';
                break;
        }

        return redirect()->route('users.index')->with('success', $message);
    }
}