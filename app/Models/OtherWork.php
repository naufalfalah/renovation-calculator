<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherWork extends Model
{
    protected $guarded = [];

    public function packages()
    {
        return $this->hasMany(OtherWorkPackage::class);
    }
}
