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


// -------------------------------temporary - must be midlware based!!!!!!!!!!!!------------------------------------------//
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
 * Route for getting a list of all tasks
 * GET Params - None
 */
Route::get('/api/v1/tasks/get_all_tasks', 'TaskController@getAllTasks');

/*
 * Route for adding a new task to the list
 * Params:
 *  - title
 *  - content
 */
Route::get('/api/v1/tasks/add_new_task', 'TaskController@addNewTask');

/*
 * Route for removing a route from the list
 * params:
 *  - uuid
 */
Route::get('/api/v1/tasks/delete_task', 'TaskController@removeExistingTask');

/*
 * Route for toggling the status of the task
 * params:
 *  - uuid
 *  - status
 */
Route::get('/api/v1/tasks/change_status', 'TaskController@changeTaskStatus');

/*
 * Route for updating task title
 * params:
 *  - uuid
 *  - title
 */
Route::get('/api/v1/tasks/update_title', 'TaskController@changeTaskTitle');

/*
 * Route for updating task content
 * params:
 *  - uuid
 *  - content
 */
Route::get('/api/v1/tasks/update_content', 'TaskController@changeTaskContent');

/*
 * Route for 404 page
 * params:
 *  - any
 */
Route::any('/api/v1/tasks/{param}', function(){
   return view('errors/404');
});