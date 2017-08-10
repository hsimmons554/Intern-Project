<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
{
    public function show()
    {
        $states = State::orderBy('state_name')->get();
        return $states;
    }
}
