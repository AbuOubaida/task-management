<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',function (){
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

    Route::middleware(['role:administrator'])->prefix('admin')->group(function () {
        Route::controller(DashboardController::class)->group(function (){
            Route::get('/dashboard','index')->name('admin.dashboard');
        });

        Route::controller(UserController::class)->prefix('user')->group(function (){
            Route::match(['get','post'],'create','create')->name('add.user');
            Route::get('list','show')->name('user.list');
            Route::match(['get','put'],'edit/{userID}','edit')->name('user.edit');
            Route::delete('delete','destroy')->name('user.delete');
        });
    });

    Route::middleware(['role:project_manager'])->prefix('project-manager')->group(function (){
        Route::controller(\App\Http\Controllers\project_manager\DashboardController::class)->group(function (){
            Route::get('/dashboard','index')->name('project.manager.dashboard');
        });
    });

    Route::middleware(['checkRole:project_manager;administrator'])->prefix('project-manage')->group(function () { // same route for multiple role permission
        Route::controller(ProjectController::class)->prefix('project')->group(function (){
            Route::match(['get','post'],'create','create')->name('add.project');

            Route::get("list",'show')->name('project.list');

            Route::match(['get','put'],'edit/{projectID}','edit')->name('project.edit');

            Route::get('single-view/{projectID}','index')->name('project.view');

            Route::delete('delete','destroy')->name('project.delete');
        });
        Route::controller(\App\Http\Controllers\TaskController::class)->prefix('project/task')->group(function (){
            Route::post('create','store')->name('create.task');
        });
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
