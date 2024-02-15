<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    function venueType()
    {
        return $this->belongsTo(VenueType::class, 'venue_type_id');
    }
}
