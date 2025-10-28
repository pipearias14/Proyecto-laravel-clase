<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with('venue')->get();//with carga la relacion definida en el modelo, muestra todos los eventos con su venue
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('event_image')) {
            $data['event_image'] = $request->file('event_image')->store('events', 'public');
        }

        $event = Event::create($data);

        return $event;
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event->load ('venue');//load carga la relacion definida en el modelo, en este caso venue
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->all();

        if ($request->hasFile('event_image')) {
            // Delete old image if exists
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            $data['event_image'] = $request->file('event_image')->store('events', 'public');
        }

        if ($event->update($data)) {
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
