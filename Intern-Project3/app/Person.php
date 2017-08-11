<?php

namespace App;

class Person extends Model
{
    // Defines M:M relationship with states table
    public function states()
    {
      return $this->belongsToMany(State::class)->withTimeStamps();
    }
}
