@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh]">
    <form method="POST" action="/login"
          class="bg-white w-full max-w-md p-8 rounded-lg shadow">

        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @error('email')
            <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <label class="block text-sm mb-1">Email</label>
            <input name="email" type="email"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
        </div>

        <div class="mb-6">
            <label class="block text-sm mb-1">Password</label>
            <input name="password" type="password"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring">
        </div>

        <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
            Login
        </button>

        <p class="text-center text-sm mt-4">
            No account?
            <a href="/register" class="underline">Register</a>
        </p>
    </form>
</div>
@endsection
