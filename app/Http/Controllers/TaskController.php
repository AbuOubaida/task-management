<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post'))
            {
                $validatedData = $request->validate([
                    'project_id' => ['required','numeric','exists:projects,id'],
                    'task_title' => ['required','string'],
                    'task_deadline' => ['required','date'],
                    'priorities' => ['required','numeric','between:1,3'],
                    'team_member' => ['required','numeric','exists:users,id'],
                    'description' => ['sometimes','nullable','string'],
                ]);
                extract($validatedData);
                Task::create([
                    'project_id' => $project_id,
                    'team_member_id' => $team_member,
                    'title' => $task_title,
                    'deadline' => $task_deadline,
                    'priorities' => $priorities,
                    'progress' => 0, //0 = Not Started
                    'description' => $description,
                    'created_by' => Auth::user()->id,
                ]);
                return back()->with('success','Task created successfully');
            }
            return back()->with('error','Requested method are not allowed!')->withInput();
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
