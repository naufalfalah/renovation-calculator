<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function packages()
    {
        return $this->hasMany(WorkPackage::class);
    }
}
