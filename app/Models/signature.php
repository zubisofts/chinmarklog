<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signature extends Model
{
    use HasFactory;

    public function parcel()
    {
        return $this->belongsTo('App\Models\parcel', 'parcel_id');
    }
}
