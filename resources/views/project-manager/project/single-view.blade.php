@extends('layouts.back-end.admin.main')
@section('mainContent')
    <div class="container-fluid px-4">
        {{--    <h1 class="mt-4">{{str_replace('-', ' ', config('app.name'))}}</h1>--}}
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-capitalize text-black">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{!! route('project.list') !!}" class="text-capitalize text-black">Project List</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-capitalize text-decoration-none ">{{str_replace('.', ' ', \Route::currentRouteName())}}</a></li>
        </ol>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="text-capitalize"><i class="fas fa-eye"></i> {{str_replace('.', ' ', \Route::currentRouteName())}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="project_title" class="col-form-label">Project Title</label>
                                <input id="project_title" type="text" class="form-control" placeholder="Project Title" value="{{ @$project->title }}" readonly>
                            </div>
                            <div class="col-sm-4">
                                <label for="project_deadline" class="col-form-label">Project Deadline</label>
                                <input id="project_deadline" type="date" class="form-control" placeholder="Project Deadline" required name="project_deadline" value="{{ @$project->deadline }}" readonly>
                            </div>
                            <div class="col-sm-4">
                                <label for="status" class="col-form-label">User Status</label>
                                <select name="status" id="status" class="form-control" readonly>
                                    <option value="1" @if(@$project->status == 1) selected @endif>Active</option>
                                    <option value="0" @if(@$project->status == 0) selected @endif>Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" readonly>{!! @$project->description !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="text-capitalize"><i class="fas fa-edit"></i> Create Task</h5>
                    </div>
                    <div class="card-body">
                        <form action="{!! route('create.task') !!}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="task_title" class="col-form-label">Task Title*</label>
                                    <input id="task_title" name="task_title" type="text" class="form-control" placeholder="Task Title" value="{{ old('task_title') }}" required>
                                    <input type="hidden" name="project_id" value="{!! @$project->id !!}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="project_deadline" class="col-form-label">Task Deadline*</label>
                                    <input id="task_deadline" type="date" class="form-control" placeholder="Task Deadline" required name="task_deadline" value="{{ old('task_deadline') }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="priorities" class="col-form-label">Task priorities*</label>
                                    <select name="priorities" id="priorities" class="form-control" required>
                                        <option value="">--select a option--</option>
                                        <option value="3" @if(old('priorities') == 3) selected @endif>High</option>
                                        <option value="2" @if(old('priorities') == 2) selected @endif>Medium</option>
                                        <option value="1" @if(old('priorities') == 1) selected @endif>Low</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="team_member" class="col-form-label">Team Member*</label>
                                    <select name="team_member" id="team_member" class="form-control" required>
                                        <option value="">--select a option--</option>
                                @isset($team_members)
                                    @foreach($team_members as $team_member)
                                        <option value="{!! $team_member->id !!}">{!! $team_member->name !!}</option>
                                    @endforeach
                                @endisset
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <label for="description" class="col-form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2" >{!! old('description')!!}</textarea>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" value="Save Task" class="btn btn-outline-success float-end mt-3">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="text-capitalize"><i class="fas fa-list"></i> Task List</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Task Title</th>
                                <th>Deadline</th>
                                <th>Description</th>
                                <th>Priorities</th>
                                <th>Progress</th>
                                <th>Team Member</th>
                                <th>Task By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($project)
                                @php($n=1)
                                @foreach($project->tasks as $task)
                                    <tr>
                                        <td>{!! $n++ !!}</td>
                                        <td>{!! $task->title !!}</td>
                                        <td>{!! date('d-m-y',strtotime($task->deadline)) !!}</td>
                                        <td>{!! \Illuminate\Support\Str::limit($task->description, 20, '....') !!}</td>
                                        <td>
                                            @if($task->priorities == 1)
                                                <span class='badge bg-secondary'>Low</span>
                                            @elseif($task->priorities == 2)
                                                <span class='badge bg-primary'>Medium</span>
                                            @elseif($task->priorities == 3)
                                                <span class='badge bg-success'>High</span>
                                            @else
                                                <span class='badge bg-danger'>Unknown</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($task->progress == 0)
                                                <span class='badge bg-warning'>Not Started</span>
                                            @elseif($task->priorities == 1)
                                                <span class='badge bg-info'>In Progress</span>
                                            @elseif($task->priorities == 3)
                                                <span class='badge bg-success'>Completed</span>
                                            @else
                                                <span class='badge bg-danger'>Unknown</span>
                                            @endif
                                        </td>
                                        <td>{!! $task->teamMember->name !!}</td>
                                        <td>{!! $task->createdBy->name !!}</td>
                                        <td>
{{--                                            <a href="{!! route('project.view',['projectID'=>\Illuminate\Support\Facades\Crypt::encryptString($project->id)]) !!}" class="text-success"><i class="fas fa-eye"></i></a>--}}
{{--                                            <a href="{!! route('project.edit',['projectID'=>\Illuminate\Support\Facades\Crypt::encryptString($project->id)]) !!}" class="text-primary"><i class="fas fa-edit"></i></a>--}}
{{--                                            <form action="{{route('project.delete')}}" class="display-inline" method="post">--}}
{{--                                                @method('delete')--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="id" value="{!! $project->id !!}">--}}
{{--                                                <button class="text-danger border-0 inline-block bg-none" onclick="return confirm('Are you sure delete this data?')"><i class="fas fa-trash"></i></button>--}}
{{--                                            </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop


