@extends('layouts.app')

@section('title', 'All Stadiums')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Stadiums</h1>
        @auth
            <a href="{{ route('stadiums.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Create New Stadium
            </a>
        @endauth
    </div>

    @if(request()->has('my_stadiums'))
        <div class="mb-4">
            <a href="{{ route('stadiums.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to All Stadiums
            </a>
        </div>
    @endif

    @if($stadiums->isEmpty())
        <div class="bg-gray-100 p-4 rounded-md">
            No stadiums found.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stadiums as $stadium)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $stadium->name }}</h3>
                        <p class="text-gray-600 mb-4">
                            <span class="block">{{ $stadium->address }}</span>
                            <span class="block mt-2">Capacity: {{ number_format($stadium->capacity) }}</span>
                            <span class="block">Price: ${{ number_format($stadium->price_per_hour, 2) }}/hour</span>
                        </p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('stadiums.show', $stadium) }}" 
                               class="text-blue-600 hover:text-blue-800">
                                View Details
                            </a>
                            @auth
                                <a href="{{ route('bookings.create', ['stadium' => $stadium->id]) }}" 
                                   class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                    Book Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $stadiums->links() }}
        </div>
    @endif
</div>
@endsection