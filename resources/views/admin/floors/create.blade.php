@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Floor</h1>

<form method="POST"
      action="{{ route('admin.floors.store') }}"
      class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Apartment</label>
        <select name="apartment_id"
                class="w-full border px-3 py-2 rounded">
            @foreach($apartments as $apartment)
                <option value="{{ $apartment->id }}">
                    {{ $apartment->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-6">
        <label class="block mb-1">Floor Number</label>
        <input name="floor_number"
               class="w-full border px-3 py-2 rounded">
    </div>

    <button class="bg-black text-white px-6 py-2 rounded">
        Save
    </button>
</form>
@endsection
