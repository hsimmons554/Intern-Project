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

Route::get('/', 'PersonController@index');
Route::post('/people', 'PersonController@store');
Route::post('/visit', 'VisitController@store');

//Route::get('/api/people', 'PersonController@show');
//Route::get('/api.php?{args}', 'PersonController@show');


/******Temp Routes Until API works*******/
Route::get('/app/people', 'PersonController@show');
Route::get('/app/people/{id}', 'PersonController@showOnePers');
Route::get('/app/people/{id}/states', 'PersonController@states');
Route::get('/app/states', 'StateController@show');
