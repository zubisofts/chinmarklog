<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quote_request extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\parcel_category', 'category_id');
    }
}
