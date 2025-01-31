<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = auth()->user()->ratings()->with('stadium')->paginate(10);
        return view('ratings.index', compact('ratings'));
    }

    public function create(Stadium $stadium)
    {
        return view('ratings.create', compact('stadium'));
    }

    public function store(Request $request, Stadium $stadium)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Check if user already rated this stadium
        if ($stadium->ratings()->where('user_id', auth()->id())->exists()) {
            return back()->withErrors(['error' => 'You already rated this stadium'])->withInput();
        }

        $rating = $stadium->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('stadiums.show', $stadium)->with('success', 'Rating submitted!');
    }

    public function edit(Rating $rating)
    {
        Gate::authorize('update', $rating);
        return view('ratings.edit', compact('rating'));
    }

    public function update(Request $request, Rating $rating)
    {
        Gate::authorize('update', $rating);

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        $rating->update($validated);
        return redirect()->route('stadiums.show', $rating->stadium)->with('success', 'Rating updated!');
    }

    public function destroy(Rating $rating)
    {
        Gate::authorize('delete', $rating);
        $rating->delete();
        return back()->with('success', 'Rating deleted!');
    }
}