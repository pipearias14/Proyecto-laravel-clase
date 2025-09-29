<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_max_capacity = $request->input('event_max_capacity');
        $event->event_is_virtual = $request->input('event_is_virtual');
        $event->save();

        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if ($event->update($request->all())) {
            return response()->json(['success' => true, 'event' => $event]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
