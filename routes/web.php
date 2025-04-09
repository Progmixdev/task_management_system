<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/projects', [ProjectController::class, 'getProjects'])->name('projects.index');
    Route::get('/projects/{projectId}/tasks', [ProjectController::class, 'getTasksByProject'])->name('projects.tasks');

    Route::get('/tasks/{projectId}/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name(name: 'tasks.store');

    Route::post('/tasks/{taskId}/toggle-status', [TaskController::class, 'toggleTaskStatus'])->name('tasks.toggleStatus');

});

require __DIR__.'/auth.php';
