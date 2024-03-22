<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Dotenv\Validator;

class TodoController extends Controller
{
    public function getTodo(){
        $todo = Todo::all();
        return $todo;
    }

    public function store(Request $request)
    {
        $todo = new Todo;
        $todo->tasks=$request->tasks;
        $todo->status=$request->status;
        $todo->created_at=$request->created_at;
        $todo->updated_at=$request->updated_at;
        $result=$todo->save();

        if($result){
            return["Result"=>"Saved"];
        }else {
            return["Result"=>"Error"];
        }
    }

    public function edit($id){
        $todo = new Todo;  
        $todo = $todo->find($id);
        if($todo){
            return response()->json([
                'status'=>200,
                'todo'=>$todo
            ],200);
        }else {
            return response()->json([
                'status'=>404,
                'message'=>'No data found.'
            ],404);
        }
    }

    public function update(Request $request, string $id)
    {
        $todo = new Todo;
        $todo = $todo->find($id);
        $todo->tasks=$request->tasks;
        $todo->status=$request->status;
        $todo->updated_at=$request->updated_at;
        $result=$todo->update();

        if($result){
            return["Result"=>"Saved"];
        }else {
            return["Result"=>"Error"];
        }
    }

    public function delete(string $id)
    {
        $todo = new Todo;
        $todo = $todo->find($id);
        return $todo->delete();
    }
}
