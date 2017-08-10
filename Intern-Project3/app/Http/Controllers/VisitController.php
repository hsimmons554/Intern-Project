<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;

class VisitController extends Controller
{
    // Handles the POST request to add a visit record
    public function store()
    {
      Visit::create([
          'person_id' => request('prs_id'),
          'state_id' => request('ste_id')
      ]);
      $record = Visit::orderBy('id', 'desc')->first();
      return $record;
    }
}
