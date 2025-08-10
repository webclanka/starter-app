<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'permissions',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'permissions' => 'array',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            if (empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }
        });

        static::updating(function ($role) {
            if ($role->isDirty('name') && empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }
        });
    }

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the number of users assigned to this role.
     */
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    /**
     * Check if the role has a specific permission.
     */
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Add a permission to the role.
     */
    public function addPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->permissions = $permissions;
            $this->save();
        }
    }

    /**
     * Remove a permission from the role.
     */
    public function removePermission($permission)
    {
        $permissions = $this->permissions ?? [];
        $permissions = array_values(array_diff($permissions, [$permission]));
        $this->permissions = $permissions;
        $this->save();
    }

    /**
     * Get all available permissions.
     */
    public static function getAvailablePermissions()
    {
        return [
            'users.view',
            'users.create', 
            'users.edit',
            'users.delete',
            'roles.view',
            'roles.create',
            'roles.edit', 
            'roles.delete',
        ];
    }
}