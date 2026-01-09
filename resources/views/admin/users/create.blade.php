@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create User</h1>

<form method="POST" action="{{ route('admin.users.store') }}"
      class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <input name="name" placeholder="Name"
           class="w-full border p-2 mb-3" required>

    <input name="email" placeholder="Email"
           class="w-full border p-2 mb-3" required>

    <input name="password" type="password"
           placeholder="Password"
           class="w-full border p-2 mb-3" required>

    <select name="role" class="w-full border p-2 mb-4">
        @foreach($roles as $role)
            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
        @endforeach
    </select>

    <button class="bg-black text-white px-4 py-2 rounded">
        Create User
    </button>
</form>
@endsection
