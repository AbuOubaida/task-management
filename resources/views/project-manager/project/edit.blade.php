@extends('layouts.back-end.admin.main')
@section('mainContent')
    <div class="container-fluid px-4">
        {{--    <h1 class="mt-4">{{str_replace('-', ' ', config('app.name'))}}</h1>--}}
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-capitalize text-black">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{!! route('project.list') !!}" class="text-capitalize text-black">Project List</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-capitalize text-decoration-none ">{{str_replace('.', ' ', \Route::currentRouteName())}}</a></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                {{--            <h1>Welcome to {{str_replace('-', ' ', config('app.name'))}} Smart Application</h1>--}}
                <h3 class="text-capitalize"><i class="fas fa-user-edit"></i> {{str_replace('.', ' ', \Route::currentRouteName())}}</h3>
            </div>
            <div class="card-body">
                <form action="{!! route('project.edit',['projectID'=>\Illuminate\Support\Facades\Crypt::encryptString(@$project->id)]) !!}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="project_title" class="col-form-label">Project Title</label>
                            <input id="project_title" type="text" class="form-control" placeholder="Project Title" required name="project_title" value="{{ @$project->title }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="project_deadline" class="col-form-label">Project Deadline</label>
                            <input id="project_deadline" type="date" class="form-control" placeholder="Project Deadline" required name="project_deadline" value="{{ @$project->deadline }}">
                        </div>
                        <div class="col-sm-4">
                            <label for="status" class="col-form-label">User Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--select a option--</option>
                                <option value="1" @if(@$project->status == 1) selected @endif>Active</option>
                                <option value="0" @if(@$project->status == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{!! @$project->description !!}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" value="Update" class="btn btn-outline-success float-end mt-3">
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@stop


