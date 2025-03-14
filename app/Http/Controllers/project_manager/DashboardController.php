<?php

namespace App\Http\Controllers\project_manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            return view('project-manager.dashboard');
        }catch (\Throwable $exception)
        {
            Log::error('An error occurred in index method: ' . $exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
            return abort(500);
        }
    }
}
