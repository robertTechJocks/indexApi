<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = "equipment";

    public function getStatsJsonAttribute($value)
    {
        return json_decode($value);
    }
}
