# API Server - todo-list-server

## About

This is the backend API server for the task managing application, built on top of laravel 5.2. 
The web application can be found here: https://github.com/ienigmax/TodoListClient

## Prerequisites

You will need the following things properly installed on your computer.

* [Git](https://git-scm.com/)
* [Composer](https://getcomposer.org/) 
* [PHP 5.5](https://windows.php.net/download/) *Windows - If not found, can be installed through XAMPP or WAMP
* [Apache](http://httpd.apache.org/download.cgi#apache24) *Not necessary, Laravel’s built in serve will also work
* 

## Installation

API Server (Laravel):
* Clone the repository
* Run “composer install” (if on windows, make sure that openssl extension is uncommented in `php.ini` and `httpd.ini` and that **PHP 5.5** is set in **PATH**)
* In ‘Databases’ directory, create ‘database.sqlite’ file
* In `.env` file, comment out all the lines related to `DB`, add the following lines:
    * DB_CONNECTION=sqlite
    * DB_DATABASE=../database/database.sqlite

    _*Note: for some reason, php artistant confuses with the DB location, when working with migrations, remove ‘../’. after finished, turn it back_
* Run `php artisan migrate`
* If you are using Apache, create a virtual host to public directory. Otherwise, use `php artisan serve`
Note: In Linux, to avoid load errors, all the files in the app directory must be owned by `apache:apache`. 

## Usage

**The API accepts the following:**

Route for getting a list of all tasks.  
Params - None
 
GET `/api/v1/tasks/get_all_tasks`

response example - `{
                 "success": true,
                 "error": null,
                 "data": [
                     {
                         "id": 1,
                         "uuid": "ee65634d3fe6c0790e8ffa907b862d40",
                         "title": "abra",
                         "content": "lorem ipsum dolor sit emet 123",
                         "created_at": "2018-09-29 14:55:10",
                         "updated_at": "2018-09-29 14:55:10",
                         "status": "0"
                     },
                     {
                         "id": 3,
                         "uuid": "1f535736499f8a12625c3036267657ef",
                         "title": "cadabra",
                         "content": "lorem ipsum dolor sit emet 1234",
                         "created_at": "2018-09-29 14:55:14",
                         "updated_at": "2018-09-29 14:55:14",
                         "status": "1"
                     }
                 ]
             }`

##

Route for adding a new task to the list.  
Params:
 - **title** - Must be encoded to base64
 - **content** - Must be encoded to base64
 
GET `/api/v1/tasks/add_new_task`

response example - `{
                        "success": true,
                        "error": null,
                        "data": "8"
                    }`

##

Route for removing a route from the list.  
Params:
 - **uuid**
 
GET `/api/v1/tasks/delete_task`

response example - `{
                        "success": true,
                        "error": null,
                        "data": 1
                    }`

##

Route for toggling the status of the task.  
Params:
 - **uuid**
 - **status**
 
GET `/api/v1/tasks/change_status`

response example - `{
                        "success": true,
                        "error": null,
                        "data": 1
                    }`

##

Route for updating task title.  
Params:
 - **uuid**
 - **title** - Must be encoded to base64
 
GET `/api/v1/tasks/update_title`

response example - `{
                        "success": true,
                        "error": null,
                        "data": 1
                    }`

##

Route for updating task content.  
Params:
 - **uuid**
 - **content** - Must be encoded to base64
 
GET `/api/v1/tasks/update_content`

response example - `{
                        "success": true,
                        "error": null,
                        "data": 1
                    }`

##

 Route for 404 page.  
 Params:
   - **any**
   
 GET `/api/v1/tasks/{param}`
 
 ##
 
 All rights recieved to iEnigxaX (AlexG) 2018