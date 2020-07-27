<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
        return response()->json($tasks);
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
}
