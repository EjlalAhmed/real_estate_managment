@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-black">Add Room</h1>

<form method="POST"
      action="{{ route('admin.rooms.store') }}"
      class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    {{-- Apartment --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Apartment</label>
        <select id="apartment" class="w-full border px-3 py-2 rounded">
            <option value="">Select Apartment</option>
            @foreach($apartments as $apartment)
                <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Floor --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Floor</label>
        <select id="floor" class="w-full border px-3 py-2 rounded" disabled>
            <option value="">Select Floor</option>
        </select>
    </div>

    {{-- Room (hidden actual submit field) --}}
    <input type="hidden" name="floor_id" id="floor_id">

    {{-- Room Number --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Room Number</label>
        <input name="room_number"
               class="w-full border px-3 py-2 rounded"
               placeholder="e.g. 203" required>
    </div>

    {{-- Type --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Type</label>
        <input name="type"
               class="w-full border px-3 py-2 rounded"
               placeholder="Studio / 1 Bed" required>
    </div>

    {{-- Price --}}
    <div class="mb-6">
        <label class="block mb-1 font-medium">Price (£)</label>
        <input name="price"
               type="number"
               class="w-full border px-3 py-2 rounded"
               required>
    </div>

    <button class="bg-black text-white px-6 py-2 rounded">
        Save Room
    </button>
</form>

{{-- JS --}}
<script>
    const apartment = document.getElementById('apartment');
    const floor = document.getElementById('floor');
    const floorInput = document.getElementById('floor_id');

    apartment.addEventListener('change', async function () {
        floor.innerHTML = '<option>Loading...</option>';
        floor.disabled = true;

        if (!this.value) return;

        const res = await fetch(`/admin/ajax/floors/${this.value}`);
        const floors = await res.json();

        floor.innerHTML = '<option value="">Select Floor</option>';
        floors.forEach(f => {
            floor.innerHTML += `<option value="${f.id}">Floor ${f.floor_number}</option>`;
        });

        floor.disabled = false;
    });

    floor.addEventListener('change', function () {
        floorInput.value = this.value;
    });
</script>
@endsection
