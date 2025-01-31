<form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="stadium_id" value="{{ $stadium->id }}">
    
    <div>
        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
        <input type="datetime-local" name="start_time" id="start_time" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>
    
    <div>
        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
        <input type="datetime-local" name="end_time" id="end_time" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </div>
    
    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
        Book Now
    </button>
</form>