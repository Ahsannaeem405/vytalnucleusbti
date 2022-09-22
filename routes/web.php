<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{dashboard,WharehouseController,LevelController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
})->name('login');


Route::get('/index', [dashboard::class, 'index'])->name('index');
Route::get('/product', [dashboard::class, 'product']);
Route::get('/inventory', [dashboard::class, 'inventory']);
Route::get('/warehouse', [dashboard::class, 'warehouse']);
Route::get('/levels', [dashboard::class, 'levels']);
Route::get('/bins', [dashboard::class, 'bins']);
Route::get('/rows', [dashboard::class, 'rows']);
Route::get('/Boxes', [dashboard::class, 'Boxes']);
Route::get('/users', [dashboard::class, 'users']);
Route::get('/roles', [dashboard::class, 'roles']);


Route::post('warehouse/save', [WharehouseController::class, 'warehouse_save']);
Route::post('warehouse/update/{id}', [WharehouseController::class, 'warehouse_update']);
Route::post('warehouse/Delete', [WharehouseController::class, 'warehouse_Delete']);

Route::post('level/store', [LevelController::class, 'level_store']);







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
