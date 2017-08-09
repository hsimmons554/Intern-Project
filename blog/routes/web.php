<?php
/*
*************Routing with RESTFul**************
GET     /posts            [select * from posts]
GET     /posts/create     [display form for creating post]
POST    /posts            [insert into posts (in database)]
GET     /posts/{id}/edit  [display form to edit post]
PATCH   /posts/{id}       [update request when above GET is submitted]
GET     /posts/{id}       [view a specific post]
DELETE  /posts/{id}       [delete request for a post]
***********************************************
*/

Route::get('/', 'PostsController@index');
//Controller => PostsController
//Eloquent Model => Post
//migrate => create_posts_table

Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
//Route::get('/posts/{post}', 'PostsController@show');

Route::get('/tasks', 'TasksController@index');

Route::get('/tasks/{tasks}', 'TasksController@show');
