<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($projectID)
    {
        try {
            $id = Crypt::decryptString($projectID);
            $project = Project::with('tasks','tasks.teamMember','tasks.createdBy','tasks.updatedBy')->find($id);
            $team_members = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'team_member');
            })->select(['name','id'])->get();
            return view('project-manager.project.single-view',compact('project','team_members'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            if ($request->isMethod('post'))
            {
                return $this->store($request);
            }
            return view('project-manager.project.create')->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post'))
            {
                $validateData = $request->validate([
                    'project_title' => ['required','string',],
                    'project_deadline' => ['sometimes', 'nullable','date'],
                    'status' => ['required','numeric','between:0,1'],
                    'description' => ['sometimes', 'nullable','string']
                ]);
                extract($validateData);

                Project::create([
                    'title' => $project_title,
                    'status' => $status,
                    'description' => $description,
                    'deadline' => $project_deadline,
                ]);
                return back()->with('success','Data save successfully');
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
    public function show()
    {
        try {
            $projects = Project::all();
            return view('project-manager.project.list',compact('projects'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $projectID)
    {
        try {
            $id = Crypt::decryptString($projectID);
            if ($request->isMethod('put'))
                return $this->update($request,$id);
            $project = Project::find($id);
            return view('project-manager.project.edit',compact('project'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->isMethod('put'))
            {
                $validateData = $request->validate([
                    'project_title' => ['required','string',],
                    'project_deadline' => ['sometimes', 'nullable','date'],
                    'status' => ['required','numeric','between:0,1'],
                    'description' => ['sometimes', 'nullable','string']
                ]);
                extract($validateData);

                Project::where('id',$id)->update([
                    'title' => $project_title,
                    'status' => $status,
                    'description' => $description,
                    'deadline' => $project_deadline,
                ]);
                return back()->with('success','Data update successfully');
            }
            return back()->with('error','Requested method are not allowed!');
        }catch (\Throwable $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
