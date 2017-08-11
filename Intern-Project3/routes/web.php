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

Route::get('/', 'AppController@index');
Route::post('/people', 'AppController@storePeople');
Route::post('/visit', 'AppController@storeVisits');

//Route::get('/api/people', 'PersonController@show');
//Route::get('/api.php?{args}', 'PersonController@show');


/******Temp Routes Until API works*******/
Route::get('/app/people', 'AppController@showPeople');
Route::get('/app/people/{id}', 'AppController@showOnePers');
Route::get('/app/people/{id}/states', 'AppController@statesByPerson');
Route::get('/app/states', 'AppController@showStates');
