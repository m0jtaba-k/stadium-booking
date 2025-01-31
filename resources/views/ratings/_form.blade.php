<form method="POST" action="{{ route('ratings.store') }}">
    @csrf
    <input type="hidden" name="stadium_id" value="{{ $stadium->id }}">
    
    <div class="mb-3">
        <label class="form-label">Rating</label>
        <div class="rating">
            @for($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                    {{ old('rating') == $i ? 'checked' : '' }}>
                <label for="star{{ $i }}">★</label>
            @endfor
        </div>
    </div>
    
    <div class="mb-3">
        <label for="comment" class="form-label">Review</label>
        <textarea class="form-control" name="comment" rows="3"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit Review</button>
</form>