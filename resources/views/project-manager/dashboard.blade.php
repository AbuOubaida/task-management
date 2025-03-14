@extends('layouts.back-end.admin.main')
@section('mainContent')
    <div class="container-fluid px-4">
        {{--    <h1 class="mt-4">{{str_replace('-', ' ', config('app.name'))}}</h1>--}}
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-capitalize text-chl">{{str_replace('.', ' ', \Route::currentRouteName())}}</a></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                {{--            <h1>Welcome to {{str_replace('-', ' ', config('app.name'))}} Smart Application</h1>--}}
                <h2>Welcome to {{str_replace('.', ' ', \Route::currentRouteName())}}</h2>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop


