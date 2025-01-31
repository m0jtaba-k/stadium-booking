<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('stadium')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $stadiums = Stadium::all();
        return view('bookings.create', compact('stadiums'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stadium_id' => 'required|exists:stadiums,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $stadium = Stadium::findOrFail($validated['stadium_id']);

        // Check for overlapping bookings
        $conflict = Booking::where('stadium_id', $stadium->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'This time slot is already booked'])->withInput();
        }

        $booking = auth()->user()->bookings()->create($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking created!');
    }

    public function edit(Booking $booking)
    {
        Gate::authorize('update', $booking);
        $stadiums = Stadium::all();
        return view('bookings.edit', compact('booking', 'stadiums'));
    }

    public function update(Request $request, Booking $booking)
    {
        Gate::authorize('update', $booking);

        $validated = $request->validate([
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $booking->update($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking updated!');
    }

    public function destroy(Booking $booking)
    {
        Gate::authorize('delete', $booking);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking canceled!');
    }
}