<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherWorkPackage extends Model
{
    protected $guarded = [];

    public function work()
    {
        return $this->belongsTo(OtherWork::class);
    }

    public function getFormattedBudgetAttribute()
    {
        $lower = number_format($this->lower_bound_budget);
        $upper = number_format($this->upper_bound_budget);

        return "$" . $lower . "-$" . $upper;
    }
}
