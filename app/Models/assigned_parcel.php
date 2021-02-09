<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class assigned_parcel extends Model
{
    use HasFactory;
    use Notifiable;

    public function parcel()
    {
        return $this->belongsTo('App\Models\parcel', 'parcel_id');
    }

}
