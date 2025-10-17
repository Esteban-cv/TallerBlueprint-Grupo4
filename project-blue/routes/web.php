<?php

use App\Http\Controllers\Project_userController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('project_user')->group(function(){
    Route::get('/index', [Project_userController::class, 'index'])->name('projectUsers.index');
    Route::get('/create', [Project_userController::class, 'create'])->name('projectUsers.create');
    Route::get('/edit/{projectUser}', [Project_userController::class, 'edit'])->name('projectUsers.edit'); // Cambiado
    Route::post('/store', [Project_userController::class, 'store'])->name('projectUsers.store');
    Route::put('/update/{projectUser}', [Project_userController::class, 'update'])->name('projectUsers.update'); // Cambiado
    Route::delete('/destroy/{projectUser}', [Project_userController::class, 'destroy'])->name('projectUsers.destroy'); // Cambiado a DELETE
});

Route::prefix('project')->group(function(){
    Route::get('/index', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/destroy/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

Route::resource('users', App\Http\Controllers\UserController::class)->except('show');

Route::resource('projects', App\Http\Controllers\ProjectController::class)->except('show');

Route::resource('tasks', App\Http\Controllers\TaskController::class)->except('show');

Route::resource('project_users', App\Http\Controllers\Project_userController::class)->except('show');
