<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parcel_category extends Model
{
    use HasFactory;

    public function pickup()
    {
        return $this->hasMany('App\Models\parcel_pickup', 'id');
    }

    public function quotes()
    {
        return $this->hasMany('App\Models\quote_request', 'id');
    }
}
