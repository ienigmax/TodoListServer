<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::resource('/api/v1/tasks', 'TaskController');

Route::get('/api/v1/tasks/get_all_tasks', 'TaskController@getAllTasks');
Route::get('/api/v1/tasks/add_new_task', 'TaskController@addNewTask');
Route::get('/api/v1/tasks/delete_task', 'TaskController@removeExistingTask');
Route::get('/api/v1/tasks/change_status', 'TaskController@changeTaskStatus');
Route::any('/api/v1/tasks/{param}', function(){
   return view('errors/404');
});