@extends('layouts.back-end.admin.main')
@section('mainContent')
    <div class="container-fluid px-4">
        {{--    <h1 class="mt-4">{{str_replace('-', ' ', config('app.name'))}}</h1>--}}
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-capitalize text-chl">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-capitalize text-chl">{{str_replace('.', ' ', \Route::currentRouteName())}}</a></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                {{--            <h1>Welcome to {{str_replace('-', ' ', config('app.name'))}} Smart Application</h1>--}}
                <h3 class="text-capitalize"><i class="fas fa-user-edit"></i> {{str_replace('.', ' ', \Route::currentRouteName())}}</h3>
            </div>
            <div class="card-body">
                <form action="{!! route('user.edit',['userID'=>\Illuminate\Support\Facades\Crypt::encryptString(@$user->id)]) !!}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="name" class="col-form-label">User Full Name</label>
                            <input id="name" type="text" class="form-control" placeholder="User Name" required name="name" value="{!! @$user->name !!}">
                        </div>
                        <div class="col-sm-4">
                            <label for="phone" class="col-form-label">User Phone</label>
                            <input id="phone" type="number" class="form-control" placeholder="User Phone" required name="phone" value="{!! @$user->phone !!}">
                        </div>
                        <div class="col-sm-4">
                            <label for="email" class="col-form-label">User Email</label>
                            <input id="email" type="email" class="form-control" placeholder="User Email" required name="email" value="{!! @$user->email !!}">
                        </div>
                        <div class="col-sm-3">
                            <label for="status" class="col-form-label">User Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--select a option--</option>
                                <option value="1" @if(@$user->status == '1') selected @endif>Active</option>
                                <option value="0" @if(@$user->status == '0') selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="role" class="col-form-label">User Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">--select a option--</option>
                                @isset($roles)
                                    @foreach($roles as $role)
                                        <option value="{!! $role->id !!}" @if($user->roles->first()->id == $role->id) selected @endif>{!! $role->display_name !!}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="new_password" class="col-form-label">User New Password</label>
                            <input id="new_password" type="password" class="form-control" placeholder="User New Password" name="password" value="" autocomplete="off">
                        </div>
                        <div class="col-sm-3">
                            <label for="confirm_password" class="col-form-label">Confirm User Password</label>
                            <input id="confirm_password" type="password" class="form-control" placeholder="Confirm User Password" name="password_confirmation" value="">
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


