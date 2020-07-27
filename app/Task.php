<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name'];

    public function refresh()
    {

        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
        return response()->json($tasks);
    }
}
