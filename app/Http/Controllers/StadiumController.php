<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StadiumController extends Controller
{
    // In StadiumController.php index method
public function index(Request $request)
{
    $query = Stadium::with(['user', 'ratings']);
    
    if ($request->has('my_stadiums')) {
        $query->where('user_id', auth()->id());
    }

    $stadiums = $query->paginate(10);
    
    return view('stadiums.index', compact('stadiums'));
}

    public function show(Stadium $stadium)
    {
        $stadium->load(['ratings.user', 'bookings.user']);
        return view('stadiums.show', compact('stadium'));
    }

    // In app/Http/Controllers/StadiumController.php

public function create()
{
    $this->authorize('create', Stadium::class);
    return view('stadiums.create', [
        'stadium' => new Stadium() // Optional: pass empty model for form binding
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'price_per_hour' => 'required|numeric|min:0',
    ]);

    $stadium = $request->user()->stadiums()->create($validated);
    
    return redirect()->route('stadiums.show', $stadium)
                    ->with('success', 'Stadium created successfully!');
}

public function edit(Stadium $stadium)
{
    $this->authorize('update', $stadium);
    return view('stadiums.edit', compact('stadium'));
}

public function update(Request $request, Stadium $stadium)
{
    $this->authorize('update', $stadium);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'price_per_hour' => 'required|numeric|min:0',
    ]);

    $stadium->update($validated);
    
    return redirect()->route('stadiums.show', $stadium)
                    ->with('success', 'Stadium updated successfully!');
}

    public function destroy(Stadium $stadium)
    {
        Gate::authorize('delete', $stadium);
        $stadium->delete();
        return redirect()->route('stadiums.index')->with('success', 'Stadium deleted!');
    }
}