<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    // Index method
    public function index()
    {
      $tasks = Task::all();
      return view('tasks.index', compact('tasks'));
    }

/*    public function show($id)
    {
      $tasks = Task::find($id);
      return view('tasks.show', compact('tasks'));
    }*/

    public function show(Task $tasks)  // Task::find(wildcard);
    {
      //$tasks = Task::find($id);
      return view('tasks.show', compact('tasks'));
    }
}
