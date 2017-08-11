<?php

namespace App;

class Person extends Model
{
    // Defines M:M relationship with states table using
    // the visits table as the derived table
    public function states()
    {
      return $this->belongsToMany(State::class, 'visits')->using(Visit::class)->orderBy('state_name');
    }
}
