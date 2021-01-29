<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parcel extends Model
{
    use HasFactory;

    public function assign()
    {
        return $this->hasOne('App\Models\assigned_parcel', 'id');
    }
}
