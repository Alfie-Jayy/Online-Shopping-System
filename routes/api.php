<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;
use Symfony\Component\Routing\RouteCompiler;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('create/categories', [RouteController::class, 'createCategory']); // Create

Route::get('get/categories', [RouteController::class, 'getCategories']); // Read
Route::get('get/category/{id}', [RouteController::class, 'getCategory']);

Route::post('update/category', [RouteController::class, 'updateCategory']); // Update

Route::post('delete/categories', [RouteController::class, 'deleteCategory']); // Delete
Route::get('delete/categories/{id}', [RouteController::class, 'deleteCategories']);

// localhost:8000/api/get/categories
// 127.0.0.1:8000/api/create/categories

