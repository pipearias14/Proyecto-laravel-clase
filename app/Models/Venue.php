<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;

    protected $fillable = [
        'venue_name',
        'venue_max_capacity',
        'venue_address',
        'venue_status',
        'fk_venue_event'
    ];

    public function events() : HasMany
    {
        return $this->hasMany(Event::class, 'fk_venue_event', 'id');//se pone primero nombre de la clase, luego la llave foranea en la tabla eventos y luego la llave primaria en la tabla venues
    }
}
