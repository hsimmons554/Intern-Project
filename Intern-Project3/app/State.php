<?php

namespace App;

class State extends Model
{
    //
    public function people()
    {
      return $this->belongsToMany(Person::class, 'visits')->using(Visit::class);
    }
}
