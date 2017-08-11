<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    // Handles the GET /people/{id}/states request
/*    public function states(Person $id)
    {
      $person = Person::find($id->id)->belongsToMany('App\State', 'visits')->orderBy('state_name')->get();
      return $person;
    }*/
}
