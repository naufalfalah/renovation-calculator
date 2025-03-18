<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function works()
    {
        return $this->hasMany(Work::class, 'room_id');
    }
}
