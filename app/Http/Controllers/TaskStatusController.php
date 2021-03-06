<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TaskStatus;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('created_at', 'desc')->paginate(10);
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_status.create', compact('taskStatus'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,',
        ]);

        $taskStatus = new TaskStatus();

        $taskStatus->name = $request->name;

        $taskStatus->save();
        flash(__('messages.saved', ['name' => 'Task Status']))->success();
        return redirect()->route('task_statuses.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
        ]);
        $taskStatus->name = $request->name;
        $taskStatus->save();
        flash(__('messages.updated', ['name' => 'Task Status']))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        flash(__('messages.deleled', ['name' => 'Task Status']))->success();
        return redirect()->route('task_statuses.index');
    }
}
