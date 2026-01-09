@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-6">
    Permissions for {{ $user->name }}
</h1>

<form method="POST"
      action="{{ route('admin.users.permissions.sync', $user) }}"
      class="bg-white dark:bg-gray-800 p-6 rounded shadow max-w-3xl">

    @csrf

    {{-- ROLE --}}
    <div class="mb-6">
        <label class="block font-medium mb-2">Role</label>
        <select name="role" class="border rounded px-3 py-2 w-64">
            @foreach($roles as $role)
                <option value="{{ $role }}"
                    {{ $user->hasRole($role) ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- PERMISSIONS --}}
    <div class="mb-6">
        <label class="block font-medium mb-3">Permissions</label>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($permissions as $permission)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox"
                           name="permissions[]"
                           value="{{ $permission->name }}"
                           {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    {{ ucfirst($permission->name) }}
                </label>
            @endforeach
        </div>
    </div>

    <button class="bg-black text-white px-5 py-2 rounded">
        Save Changes
    </button>
</form>
@endsection
