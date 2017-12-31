<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'card_id' => 'required|exists:cards,id',
            'name'    => 'required|string'
        ]);

        // static model method?
        $max_order_key = DB::table('tasks')
                            ->where('card_id', request('card_id'))
                            ->max('order_key');

        $task = Task::create([
            'card_id'   => request('card_id'),
            'name'      => request('name'),
            'order_key' => ++$max_order_key
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if (auth()->id() != $task->card->board->user_id) {
            return response(null, 404);
        }

        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function updateOrder(Request $request)
    {
        $tasks = collect(request('items'));

        // Loop over each task and update order_key column to be the array
        // index from the posted data
        $tasks->each(function($task_data, $key) {

            $task = Task::find($task_data['id']);

            // Validate task belongs to us
            if (auth()->id() != $task->card->board->user_id) {
                return;
            }

            // Update order_key and save
            $task->order_key = $key;
            $task->save();
        });

        return response()->json(['data' => ['success' => true]]);
    }
}
