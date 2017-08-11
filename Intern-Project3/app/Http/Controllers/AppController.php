<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Visit;
use App\Person;

class AppController extends Controller
{
    // Handles inital GET request for loading App
    public function index()
    {
         return view('homePage');
    }

    // Handles the GET /people/{id} request
    public function showOnePers(Person $id)
    {
      $person = Person::find($id);
      return $person;
    }

    // Handles the GET request for all people data
    public function showPeople()
    {
        $person = Person::orderBy('first_name')->orderBy('last_name')->get();
        return $person;
    }

    // Handles the GET request for all the state data
    public function showStates()
    {
        $states = State::orderBy('state_name')->get();
        return $states;
    }

    // Handles the GET request for states for a specific person
    public function statesByPerson(Person $id)
    {
        $list = $id->states()->orderBy('state_name')->get();
        return $list;
    }

    // Handles the POST request to add a person record
    public function storePeople()
    {
      Person::create([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'favorite_food' => request('favorite_food')
      ]);
      $record = Person::orderBy('id', 'desc')->first();
      return $record;
    }

    // Handles the POST request to add a visit record
    public function storeVisits(Person $prs_id)
    {
      $prs_id->states()->attach(request('ste_id'));
      $record = $prs_id->states()->orderBy('person_state.created_at', 'desc')->first();
      return $record;
    }
}
