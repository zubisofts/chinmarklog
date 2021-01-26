<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;

    public function riders()
    {
        return $this->hasMany('App\Models\rider');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\state', 'state_id');
    }
}
