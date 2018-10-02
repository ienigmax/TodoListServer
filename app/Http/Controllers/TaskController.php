<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskModel;

class TaskController extends Controller
{

    public function getAllTasks() {

        // Get all tasks
        $taskList = TaskModel::all();

        if(empty($taskList)){
            return ['success' => false, 'error' => 'empty list', 'data' => null];
        } else {
            return ['success' => true, 'error' => null, 'data' => $taskList];
        }
    }


    public function addNewTask(Request $request) {

        $params = $request->query();

        if((!isset($params['title'])) or (empty($params['title']))){
            return ['success' => false, 'error' => 'title missing'];
        } else if((!isset($params['content'])) or (empty($params['content']))){
            return ['success' => false, 'error' => 'content missing'];
        }

        $result = TaskModel::insertTask(['title' => $params['title'], 'content' => $params['content']]);

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'insert failed', 'data' => null];
        }

    }


    public function removeExistingTask(Request $request) {

        $params = $request->query();
        if((!isset($params['uuid'])) or (empty($params['uuid']))){
            return ['success' => false, 'error' => 'uuid missing'];
        }

        $result = TaskModel::deleteTask($params['uuid']);

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'remove failed', 'data' => null];
        }

    }

    public function changeTaskStatus(Request $request) {

        $params = $request->query();

        if((!isset($params['status'])) or (empty($params['status']))){
            return ['success' => false, 'error' => 'status missing'];
        } else if((!isset($params['uuid'])) or (empty($params['uuid']))){
            return ['success' => false, 'error' => 'uuid missing'];
        }

        if($params['status'] === 'off'){
            $params['status'] = '0';
        } else if($params['status'] === 'on'){
            $params['status'] = '1';
        }

        $result = TaskModel::updateTaskStatus($params['uuid'], $params['status']);

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'update failed', 'data' => null];
        }

    }

    public function changeTaskTitle(Request $request) {

        $params = $request->query();

        if((!isset($params['title'])) or (empty($params['title']))){
            return ['success' => false, 'error' => 'title missing'];
        } else if((!isset($params['uuid'])) or (empty($params['uuid']))){
            return ['success' => false, 'error' => 'uuid missing'];
        }

        $result = TaskModel::updateTaskTitle($params['uuid'], $params['title']);

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'update failed', 'data' => null];
        }

    }

    public function changeTaskContent(Request $request) {

        $params = $request->query();

        if((!isset($params['content'])) or (empty($params['content']))){
            return ['success' => false, 'error' => 'content missing'];
        } else if((!isset($params['uuid'])) or (empty($params['uuid']))){
            return ['success' => false, 'error' => 'uuid missing'];
        }

        $result = TaskModel::updateTaskContent($params['uuid'], $params['content']);

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'update failed', 'data' => null];
        }

    }

}
