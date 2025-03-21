<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectStatsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Project routes
    Route::apiResource('projects', ProjectController::class);

    // Task routes (nested under projects)
    Route::prefix('projects/{project}')->group(function () {
        // Create a task for a specific project
        Route::post('/tasks', [TaskController::class, 'store']);

        // Update a specific task
        Route::put('/tasks/{task}', [TaskController::class, 'update']);

        // Delete a specific task
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    });

    // Reporting endpoint
    //Route::get('/projects/{project}/stats', [ProjectStatsController::class, 'stats']);
});
