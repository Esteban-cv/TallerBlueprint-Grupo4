<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        return view('task.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create(Request $request)
    {
        
        return view('task.create');
    }

    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());

        $request->session()->flash('task.id', $task->id);

        return redirect()->route('tasks.index');
    }

    public function edit(Request $request, Task $task)
    {
        return view('task.edit', [
            'task' => $task,
        ]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        $request->session()->flash('task.id', $task->id);

        return redirect()->route('tasks.index');
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
