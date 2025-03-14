@extends('layouts.back-end.admin.main')
@section('mainContent')
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-capitalize text-chl">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-capitalize text-chl">{{str_replace('.', ' ', \Route::currentRouteName())}}</a></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                {{--            <h1>Welcome to {{str_replace('-', ' ', config('app.name'))}} Smart Application</h1>--}}
                <h3 class="text-capitalize"><i class="fas fa-list"></i> {{str_replace('.', ' ', \Route::currentRouteName())}}</h3>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Project Title</th>
                        <th>Deadline</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($projects)
                        @php($n=1)
                        @foreach($projects as $project)
                            <tr>
                                <td>{!! $n++ !!}</td>
                                <td>{!! $project->title !!}</td>
                                <td>{!! date('d-m-y',strtotime($project->deadline)) !!}</td>
                                <td>{!! \Illuminate\Support\Str::limit($project->description, 50, '....') !!}</td>
                                <td >{!! ($project->status == 1)? "<span class='badge bg-success'>Active</span":"<span class='badge bg-danger'>Inactive</span" !!}</td>
                                <td>
                                    <a href="{!! route('project.view',['projectID'=>\Illuminate\Support\Facades\Crypt::encryptString($project->id)]) !!}" class="text-success"><i class="fas fa-eye"></i></a>
                                    <a href="{!! route('project.edit',['projectID'=>\Illuminate\Support\Facades\Crypt::encryptString($project->id)]) !!}" class="text-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('project.delete')}}" class="display-inline" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{!! $project->id !!}">
                                        <button class="text-danger border-0 inline-block bg-none" onclick="return confirm('Are you sure delete this data?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop
