@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create Apartment</h1>

<form method="POST" action="{{ route('admin.apartments.store') }}"
      class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Name</label>
        <input name="name" class="w-full border px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Location</label>
        <input name="location" class="w-full border px-3 py-2 rounded">
    </div>

    <div class="mb-6">
        <label class="block mb-1">Description</label>
        <textarea name="description"
                  class="w-full border px-3 py-2 rounded"></textarea>
    </div>

    <button class="bg-black text-white px-6 py-2 rounded">
        Save
    </button>
</form>
@endsection
