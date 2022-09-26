<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{dashboard,WharehouseController,LevelController,AjaxController,BinController,RowController,BoxController,CreateRole};

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



Route::post('/create_role', [CreateRole::class, 'create_role']);


Route::get('/index', [dashboard::class, 'index'])->name('index');
Route::get('/product', [dashboard::class, 'product']);
Route::get('/inventory', [dashboard::class, 'inventory']);
Route::get('/warehouse', [dashboard::class, 'warehouse'])->middleware('can:warehouse');
Route::get('/levels', [dashboard::class, 'levels'])->middleware('can:levels');
Route::get('/bins', [dashboard::class, 'bins'])->middleware('can:bins');
Route::get('/rows', [dashboard::class, 'rows'])->middleware('can:rows');
Route::get('/Boxes', [dashboard::class, 'Boxes'])->middleware('can:Boxes');
Route::get('/users', [dashboard::class, 'users']);
Route::get('/roles', [dashboard::class, 'roles']);


Route::post('warehouse/save', [WharehouseController::class, 'warehouse_save']);
Route::post('warehouse/update/{id}', [WharehouseController::class, 'warehouse_update']);
Route::post('warehouse/Delete', [WharehouseController::class, 'warehouse_Delete']);




Route::post('level/store', [LevelController::class, 'level_store']);
Route::post('level/update/{id}', [LevelController::class, 'level_update']);
Route::post('level/Delete', [LevelController::class, 'level_Delete']);





Route::post('bin/save', [BinController::class, 'bin_save']);
Route::post('bin/update/{id}', [BinController::class, 'bin_update']);
Route::post('bin/Delete', [BinController::class, 'bin_Delete']);




Route::post('row/save', [RowController::class, 'row_save']);
Route::post('row/update/{id}', [RowController::class, 'row_update']);
Route::post('row/Delete', [RowController::class, 'row_Delete']);


Route::post('box/save', [BoxController::class, 'box_save']);
Route::post('box/update/{id}', [BoxController::class, 'box_update']);
Route::post('box/Delete', [BoxController::class, 'box_Delete']);


Route::get('/get_level', [AjaxController::class, 'get_level']);
Route::get('/get_bins', [AjaxController::class, 'get_bins']);
Route::get('/get_row', [AjaxController::class, 'get_row']);





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
