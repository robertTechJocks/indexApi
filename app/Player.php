<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function getSimStatsAttribute($value) {
        return json_decode($value);
      }
}
