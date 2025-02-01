@extends('layouts.app')

@section('title', 'My Bookings')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">My Bookings</h1>

    @if($bookings->isEmpty())
        <div class="bg-gray-100 p-4 rounded-md">
            No bookings found.
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Stadium</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Time</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4">{{ $booking->stadium->name }}</td>
                        <td class="px-6 py-4">{{ $booking->start_time->format('M, d, Y') }}</td>
                        <td class="px-6 py-4">
                            {{ $booking->start_time->format('h:i A') }} - 
                            {{ $booking->end_time->format('h:i A') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('bookings.edit', $booking) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Are you sure?')">Cancel</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection