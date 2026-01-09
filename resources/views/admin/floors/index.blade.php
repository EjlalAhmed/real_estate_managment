@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold text-black">Floors</h1>
    <a href="{{ route('admin.floors.create') }}"
       class="bg-black text-white px-4 py-2 rounded">
        + Add Floor
    </a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left text-black font-medium">Apartment</th>
                <th class="p-3 text-left text-black font-medium">Floor Number</th>
                <th class="p-3 text-left text-black font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($floors as $floor)
            <tr class="border-t">
                <td class="p-3 text-black font-medium">{{ $floor->apartment->name }}</td>
                <td class="p-3 text-black font-medium">{{ $floor->floor_number }}</td>
                <td class="p-3">
                    <form method="POST"
                          action="{{ route('admin.floors.destroy', $floor) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
