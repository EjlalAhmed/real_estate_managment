@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Users</h1>

    @can('create users')
    <a href="{{ route('admin.users.create') }}"
       class="bg-black text-white px-4 py-2 rounded hover:opacity-90">
        + Add User
    </a>
    @endcan
</div>

<div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="p-3 border text-left">Name</th>
                <th class="p-3 border text-left">Email</th>
                <th class="p-3 border text-left">Role</th>
                <th class="p-3 border text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-3 border">{{ $user->name }}</td>
                <td class="p-3 border">{{ $user->email }}</td>
                <td class="p-3 border">
                    {{ $user->roles->pluck('name')->implode(', ') ?: '-' }}
                </td>

                <td class="p-3 border space-x-3">
                    {{-- Permissions --}}
                    @can('manage users')
                    <a href="{{ route('admin.users.permissions', $user) }}"
                       class="text-blue-600 hover:underline">
                        Permissions
                    </a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
