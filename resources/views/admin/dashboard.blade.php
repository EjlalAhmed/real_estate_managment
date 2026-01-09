@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-black mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-sm text-black">Total Apartments</h3>
        <p class="text-3xl font-bold mt-2 text-black ">{{ $totalApartments }}</p>
    </div>
</div>
@endsection
