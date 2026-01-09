<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * List all users
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function create()
    {
        $roles = Role::pluck('name');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign role
        $user->assignRole($data['role']);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Permission / Role edit form
     */
    public function permissions(User $user)
    {
        $roles = Role::pluck('name');
        $permissions = Permission::all();

        return view('admin.users.permissions', compact(
            'user',
            'roles',
            'permissions'
        ));
    }

    /**
     * Sync role + permissions
     */
    public function syncPermissions(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|exists:roles,name',
            'permissions' => 'array',
        ]);

        // Single-role system
        $user->syncRoles([$data['role']]);

        // Permissions
        $user->syncPermissions($data['permissions'] ?? []);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User role & permissions updated');
    }
}
