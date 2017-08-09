<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tasks', 'TasksController@index');

Route::get('/tasks/{tasks}', 'TasksController@show');

/*Route::get('/', function () {
    //$fname = 'Harold';
    //$lname = 'Simmons';
    //return view('welcome')->with('name', 'Harold');
    //return view('welcome', compact('fname', 'lname'));
    $tasks = DB::table('tasks')->get();

    //return $tasks;
  /*  $tasks = [
      'Go to the store',
      'Finish my screencase',
      'Clean the house'
    ];*//*
    return view('welcome', compact('tasks'));
});*/
/*
Route::get('/tasks', function(){
  //$tasks = DB::table('tasks')->latest()->get();
  //$tasks = App\Task::all();
  $tasks = Task::all();
  //$tasks = Task::incomplete();
  return view('tasks.index', compact('tasks'));
}); */
/*
Route::get('/tasks/{id}', function($id){
    //$tasks = DB::table('tasks')->find($id);
    //$tasks = App\Task::find($id);
    $tasks = Task::find($id);
    return view('tasks.show', compact('tasks'));
});*/
