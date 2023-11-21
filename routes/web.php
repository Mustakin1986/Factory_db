<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SmvController;
use App\Http\Controllers\Admin\lineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UniteController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EfficiencyController;

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

// Route::get('/admin/dashboard',function(){
//     return view('dashboard');
// });

//Smv Library
Route::resource('/api/smv_libraries',SmvController::class);
//line
Route::resource('/api/lines',lineController::class);
Route::get('/api/lines/{unite_id}',[lineController::class,'getLine']);
//Unite
Route::resource('/api/unites',UniteController::class);
//Efficiency report
 Route::resource('/api/efficiencies',EfficiencyController::class);

//brand
Route::get('/api/brands',[BrandController::class,'index']);
Route::post('/api/brands/create',[BrandController::class,'store']);
// category
Route::get('/api/categories',[CategoryController::class,'index']);
Route::post('/api/categories/create',[CategoryController::class,'store']);
//user
Route::get('/api/users',[UserController::class,'index']);
Route::post('/api/users/create',[UserController::class,'store']);
Route::get('/api/users/{user}/edit', [UserController::class, 'edit']);
Route::patch('/api/users/{user}/change-role', [UserController::class, 'ChangeRole']);
Route::put('/api/users/{user}/update', [UserController::class, 'update']);
Route::delete('/api/users/{user}', [UserController::class, 'destroy']);

Route::put('/api/profile', [ProfileController::class, 'getUser']);

Route::get('{view}',ApplicationController::class)->where('view','.*');


