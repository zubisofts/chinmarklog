<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assigned_pickup extends Model
{
    use HasFactory;

    public function pickup()
    {
        return $this->belongsTo('App\Models\parcel_pickup', 'parcel_id');
    }
}
