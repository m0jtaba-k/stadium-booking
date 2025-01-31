@extends('layouts.app')

@section('title', $stadium->name)
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <h1 class="text-3xl font-bold">{{ $stadium->name }}</h1>
                @can('update', $stadium)
                    <div class="flex space-x-2">
                        <a href="{{ route('stadiums.edit', $stadium) }}" 
                           class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">
                            Edit
                        </a>
                        <form action="{{ route('stadiums.destroy', $stadium) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this stadium?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <div class="space-y-4">
                <p class="text-gray-600">
                    <span class="font-semibold">Address:</span> {{ $stadium->address }}
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Capacity:</span> {{ number_format($stadium->capacity) }}
                </p>
                <p class="text-gray-600">
                    <span class="font-semibold">Price per hour:</span> ${{ number_format($stadium->price_per_hour, 2) }}
                </p>
            </div>

            @auth
                <div class="mt-8">
                    <a href="{{ route('bookings.create', ['stadium' => $stadium->id]) }}" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 inline-block">
                        Book This Stadium
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection