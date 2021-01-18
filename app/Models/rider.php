<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rider extends Model
{
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo('App\Models\branch', 'branch_id', 'id');
    }
}
