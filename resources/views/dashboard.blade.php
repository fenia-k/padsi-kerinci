<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard</h1>

    <!-- Contoh Konten Statis -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Welcome to the Dashboard</h2>
            <p>Here you can view summaries, statistics, and manage data.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold">User Guide</h2>
            <p>Read the user guide to understand the application better.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Support</h2>
            <p>Contact support if you need any help.</p>
        </div>
    </div>
</div>
@endsection
