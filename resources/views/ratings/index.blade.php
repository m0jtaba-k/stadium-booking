@extends('layouts.app')

@section('title', 'My Ratings')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold mb-4">My Ratings</h1>
            
            @if($ratings->isEmpty())
                <p class="text-gray-600">No ratings found.</p>
            @else
                <div class="space-y-4">
                    @foreach($ratings as $rating)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold">{{ $rating->stadium->name }}</h3>
                                <div class="flex items-center mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="h-5 w-5 {{ $i < $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                @if($rating->comment)
                                    <p class="mt-2 text-gray-600">{{ $rating->comment }}</p>
                                @endif
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('ratings.edit', $rating) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('ratings.destroy', $rating) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $ratings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection