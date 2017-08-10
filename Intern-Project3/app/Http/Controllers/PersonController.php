<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    public function index()
    {
         return view('homePage');
    }

    // Handles the GET all people requests
    public function show() {
        $person = Person::orderBy('first_name')->orderBy('last_name')->get();
        return $person;
    }

    // Handles the GET /people/{id} request
    public function showOnePers(Person $id)
    {
      $person = Person::find($id);
      return $person;
    }

    // Handles the GET /people/{id}/states request
    public function states(Person $id)
    {
      $person = Person::find($id->id)->belongsToMany('App\State', 'visits')->orderBy('state_name')->get();
      return $person;
    }

    // Handles the POST request to add a person record
    public function store() {
      Person::create([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'favorite_food' => request('favorite_food')
      ]);
      $record = Person::orderBy('id', 'desc')->first();
      return $record;

    }
}
