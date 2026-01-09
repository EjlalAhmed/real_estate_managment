@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold">User Dashboard</h1>

<p class="mt-2">
    Welcome {{ auth()->user()->name }} 👋
</p>

<div class="mt-6 bg-white p-4 rounded shadow">
    <p>Your role: <b>{{ auth()->user()->getRoleNames()->first() }}</b></p>
</div>
@endsection
