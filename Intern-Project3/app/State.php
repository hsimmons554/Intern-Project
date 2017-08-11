<?php

namespace App;

class State extends Model
{
    // Defines M:M relationship with people table
    public function people()
    {
      return $this->belongsToMany(Person::class)->withTimeStamps();
    }
}
