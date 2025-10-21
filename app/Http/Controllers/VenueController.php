<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Venue::with('events')
        ->where('venue_max_capacity', '>', $request->input('capacity'))
        ->orWhere('venue_status', true)
        ->get();
        //with carga la relacion definida en el modelo, muestra todos los venues con sus eventos
        //muestra los que son mayores a la capacidad o que son true en status
        //return Venue::all();//muestra todos los venues sin eventos

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = new Venue($request->validated());//tiene la particularidad, que solo nos entrega las claves validadas en form request
        $venue->save();
        return response()->json(['success' => true, 'venue' => $venue]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
       // return $venue;//solo se retorna el objeto, porque laravel ya lo busco por id antes de entrar a este metodo
        //return response()->json(['success' => true, 'venue' => $venue, 'events' => $venue->events()->get()]);
        //devuelve un json con exito y el objeto venue
        //mostrar los eventos de este venue
        //el get me convierte la consulta events() en una coleccion de objetos

        return response()->json(['success' => true, 'venue' => $venue->load('events')]);//load carga la relacion definida en el modelo, en este caso events

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        if ($venue->update($request->validated())) {
            return response()->json(['success' => true, 'venue' => $venue]);
        }
        return response()->json(['success' => false, 'venue' => $venue]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        if ($venue->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'venue' => $venue]);
    }
}
