<?php

namespace App\Http\Controllers\Web;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


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
            'event_max_capacity' => 'integer|min:1',
            'event_speaker_name' => 'required|string|max:255',
            'event_location_name' => 'nullable|string|max:255',
            'event_meetup_url' => 'nullable|url',
            'event_is_virtual' => 'boolean',
            'fk_venue_event' => 'nullable|exists:venues,id',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('event_image')) {
            $data['event_image'] = $request->file('event_image')->store('events', 'public');
        }

        Event::create($data);

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
            'event_max_capacity' => 'integer|min:1',
            'event_speaker_name' => 'required|string|max:255',
            'event_location_name' => 'nullable|string|max:255',
            'event_meetup_url' => 'nullable|url',
            'event_is_virtual' => 'boolean',
            'fk_venue_event' => 'nullable|exists:venues,id',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('event_image')) {
            // Delete old image if exists
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            $data['event_image'] = $request->file('event_image')->store('events', 'public');
        }

        $event->update($data);

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