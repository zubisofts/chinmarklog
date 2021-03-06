<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rider extends Model
{
    use HasFactory;
    use Notifiable;

    public function branch()
    {
        return $this->belongsTo('App\Models\branch', 'branch_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id');
    }

}
