@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8 mt-8">
    <h2 class="text-xl font-bold mb-6">Admin Profile</h2>
    <div class="space-y-4">
        <div>
            <span class="font-semibold">Name:</span>
            <span>{{ $user->name }}</span>
        </div>
        <div>
            <span class="font-semibold">Email:</span>
            <span>{{ $user->email }}</span>
        </div>
        <div>
            <span class="font-semibold">Role:</span>
            <span>Admin</span>
        </div>
        <div>
            <span class="font-semibold">Created At:</span>
            <span>{{ $user->created_at->format('d M Y') }}</span>
        </div>
    </div>
</div>
@endsection
