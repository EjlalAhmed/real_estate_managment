@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold text-black">Apartments</h1>
    <a href="{{ route('admin.apartments.create') }}"
       class="bg-black text-white px-4 py-2 rounded">
        + Add Apartment
    </a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-3 text-black font-medium">Name</th>
                <th class="p-3 text-black font-medium">Location</th>
                <th class="p-3 text-black font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($apartments as $apartment)
            <tr class="border-t">
                <td class="p-3 text-black font-medium">{{ $apartment->name }}</td>
                <td class="p-3 text-black font-medium">{{ $apartment->location }}</td>
                <td class="p-3">
                    <form method="POST"
                          action="{{ route('admin.apartments.destroy', $apartment) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
