<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Task $tasks
     * @return JsonResponse
     */
    public function index(Task $tasks)
    {
        if(request('q')!== null){
           $tasks['data'] = Task::where('name', 'like', '%' . request('q'). '%')->get();
            return response()->json($tasks);
        }else{
            return $tasks->refresh();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
       $task = Task::create($request->all());
       if ($task){
         return $task->refresh();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $tasks = Task::find($id);
        return response()->json($tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update($id)
    {
        $task = Task::find($id);
        $task->name = request('name');
        $task->save();
        if($task){
            return $task->refresh();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
       $task = Task::find($id);

       if($task->delete()){
          return $task->refresh();
       }else{
           return response()->json(['error' =>'Destroy method has failed .'], 425);
       }

    }

    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function tasks(): JsonResponse
    {
        $tasks = Task::all();
        //throw new \Exception('Test Exception 2');

        dd($tasks);
        return response()->json($tasks);
    }
}
