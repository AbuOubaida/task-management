<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class DashboardController extends Controller
{
    //For Index
    public function index()
    {
//        return redirect(Auth::user()->roles()->first()->name.'/dashboard');
        if (Auth::user()->hasRole('administrator')) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasRole('project_manager')) {
//            return redirect('admin/dashboard');
            return redirect()->route('project.manager.dashboard');
        } elseif (Auth::user()->hasRole('team_member')) {
            return redirect()->route('team.member.dashboard');
        }
        return view('/');
    }
}
