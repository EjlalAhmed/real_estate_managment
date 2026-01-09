@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <form method="POST" action="/register"
          class="bg-white w-full max-w-md p-8 rounded-lg shadow">

        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <div class="mb-4">
            <label class="block text-sm mb-1">Name</label>
            <input name="name"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input name="email" type="email"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-6">
            <label class="block text-sm mb-1">Password</label>
            <input name="password" type="password"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
            Create Account
        </button>
    </form>
</div>
@endsection
