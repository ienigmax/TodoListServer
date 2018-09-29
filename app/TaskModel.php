<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskModel extends Model
{
    protected $table = 'tasks';

    public static function insertTask(array $data){

        $self = new static;

        DB::insert('INSERT INTO ' . $self->table . ' (uuid, title, content, created_at, updated_at) VALUES (?,?,?,?,?)', [md5($data['content'] . time() . rand()), $data['title'], $data['content'], time(), time()]);
        return DB::getPdo()->lastInsertId();
    }

    public static function deleteTask($uuid){

        $self = new static;
        return DB::delete('DELETE FROM ' . $self->table . ' WHERE uuid=?', [$uuid]);

    }

    public static function updateTaskStatus($uuid, $status){

        $self = new static;
        return DB::update('UPDATE ' . $self->table . ' SET status=? WHERE uuid=?', [$status, $uuid]);

    }
}
