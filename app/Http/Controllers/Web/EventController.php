<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Events/Index', [
            'events' => Event::with('venue')->get(),
            'venues' => Venue::all(),
            'message' => session('message')
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create', [
            'venues' => Venue::all(),
            'selectedVenue' => request('venue_id')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_is_virtual' => 'boolean',
            'event_speaker_name' => 'required|string|max:255',
            'fk_venue_event' => 'nullable|exists:venues,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('message', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return Inertia::render('Events/Show', [
            'event' => $event->load('venue')
        ]);
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event,
            'venues' => Venue::all()
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_is_virtual' => 'boolean',
            'event_speaker_name' => 'required|string|max:255',
            'fk_venue_event' => 'nullable|exists:venues,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('message', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('message', 'Event deleted successfully.');
    }
}