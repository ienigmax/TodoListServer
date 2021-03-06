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
        } else if(!$this->is_base64_encoded($params['title'])){
            return ['success' => false, 'error' => 'title must be base64 encoded'];
        } else if(!$this->is_base64_encoded($params['content'])){
            return ['success' => false, 'error' => 'content must be base64 encoded'];
        }

        $result = TaskModel::insertTask(['title' => base64_decode($params['title']), 'content' => base64_decode($params['content'])]);

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
        } else if(!$this->is_base64_encoded($params['title'])){
            return ['success' => false, 'error' => 'title must be base64 encoded'];
        }

        $result = TaskModel::updateTaskTitle($params['uuid'], base64_decode($params['title']));

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
        } else if(!$this->is_base64_encoded($params['content'])){
            return ['success' => false, 'error' => 'content must be base64 encoded'];
        }

        $result = TaskModel::updateTaskContent($params['uuid'], base64_decode($params['content']));

        if((isset($result)) && ($result !== 0)){
            return ['success' => true, 'error' => null, 'data' => $result];
        } else {
            return ['success' => false, 'error' => 'update failed', 'data' => null];
        }

    }

    private function is_base64_encoded($data){
        if (preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $data)) {
           return TRUE;
        } else {
            return FALSE;
        }
    }

}
