<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPackage extends Model
{
    protected $guarded = [];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
