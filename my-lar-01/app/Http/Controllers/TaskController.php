<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    //
    public function getTask() {
        $task = Task::all();
        return response()->json($task, 200);
    }

    public function postCreate(Request $req) {
        if(Task::insert($req->all())) {
            return response('User has been created', 201);
        }else {
            return response('Cannot create user');
        }
    }

    public function editTask(Request $req, $id) {
        if(Task::where('id',$id)->update($req->all())) {
            return response()->json(Task::find($id), 200);
        }else {
            return response('Cannot update');
        }
    }
}
