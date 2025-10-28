<?php

namespace App\Http\Controllers\Web;

use App\Models\Venue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Venues/Index', [
            'venues' => Venue::all(),
            'message' => session('message'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Venues/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $validated = $request->validate([
                'venue_name' => 'required|string|max:255',
                'venue_address' => 'required|string|max:255',
                'venue_max_capacity' => 'required|integer|min:1',
            ]);

            Venue::create($validated);

            return redirect()->route('venues.index')
                ->with('message', 'Venue created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return Inertia::render('Venues/Show', [
            'venue' => $venue
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return Inertia::render('Venues/Edit', [
            'venue' => $venue
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string|max:255',
            'venue_max_capacity' => 'required|integer|min:1',
        ]);

        $venue->update($validated);

        return redirect()->route('venues.index')
            ->with('message', 'Venue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('venues.index')
            ->with('message', 'Venue deleted successfully.');
    }
}
