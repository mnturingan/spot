<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueType extends Model
{
    use HasFactory;

    function venueTypeImgs(){
        return $this->hasMany(VenueTypeImage::class, 'venue_type_id');
    }
}
