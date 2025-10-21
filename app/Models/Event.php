<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_date',
        'event_max_capacity',
        'event_speaker_name',
        'event_location_name',
        'event_meetup_url',
        'event_is_virtual',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'fk_venue_event', 'id');//se pone primero nombre de la clase, luego la llave foranea en la tabla eventos y luego la llave primaria en la tabla venues
    }
}
