<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{dashboard,WharehouseController,LevelController,AjaxController,BinController,RowController,BoxController,CreateRole,AddProduct,Import};

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
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
Route::get('/cls', function() {
  $run = Artisan::call('config:clear');
  $run = Artisan::call('cache:clear');
  $run = Artisan::call('config:cache');
  $run = Artisan::call('view:clear');
  Session::flush();
  return 'FINISHED';
});


Route::get('/', function () {
    return view('auth/login');
})->name('login')->middleware('login');

Route::get('/send_in_queue', [AjaxController::class, 'send_in_queue']);
Route::get('/start_queue', [AjaxController::class, 'start_queue']);



Route::post('/create_role', [CreateRole::class, 'create_role'])->middleware('can:Roles');
Route::get('/edit_role/{id}', [CreateRole::class, 'edit_role'])->middleware('can:Roles');
Route::post('/update_role/{id}', [CreateRole::class, 'update_role'])->middleware('can:Roles');




Route::get('/create_roles', function () {
    return view('dashboard/create_roles');
})->middleware('can:Roles');

Route::get('/index', [dashboard::class, 'index'])->name('index');
Route::get('/inventory', [dashboard::class, 'inventory'])->middleware('can:Boxes');
Route::get('/warehouse', [dashboard::class, 'warehouse'])->middleware('can:warehouse');
// Route::get('/levels', [dashboard::class, 'levels'])->middleware('can:levels');
// Route::get('/bins', [dashboard::class, 'bins'])->middleware('can:bins');
// Route::get('/rows', [dashboard::class, 'rows'])->middleware('can:rows');
Route::get('/Boxes', [dashboard::class, 'Boxes'])->middleware('can:Boxes');
Route::get('/users', [dashboard::class, 'users']);
Route::get('/roles', [dashboard::class, 'roles']);


Route::post('/user/update/{id}', [WharehouseController::class, 'user_update']);
Route::post('/user/create', [WharehouseController::class, 'user_create']);



Route::post('warehouse/save', [WharehouseController::class, 'warehouse_save']);
Route::post('warehouse/update/{id}', [WharehouseController::class, 'warehouse_update']);
Route::post('warehouse/Delete', [WharehouseController::class, 'warehouse_Delete']);




// Route::post('level/store', [LevelController::class, 'level_store']);
// Route::post('level/update/{id}', [LevelController::class, 'level_update']);
// Route::post('level/Delete', [LevelController::class, 'level_Delete']);
//
//
//
//
//
// Route::post('bin/save', [BinController::class, 'bin_save']);
// Route::post('bin/update/{id}', [BinController::class, 'bin_update']);
// Route::post('bin/Delete', [BinController::class, 'bin_Delete']);
//
//
//
//
// Route::post('row/save', [RowController::class, 'row_save']);
// Route::post('row/update/{id}', [RowController::class, 'row_update']);
// Route::post('row/Delete', [RowController::class, 'row_Delete']);


Route::post('box/save', [BoxController::class, 'box_save']);
Route::post('box/update/{id}', [BoxController::class, 'box_update']);
Route::get('print_label/{id}', [BoxController::class, 'print_label']);
Route::get('print_barcode/{id}', [BoxController::class, 'print_barcode']);
Route::post('box/Delete', [BoxController::class, 'box_Delete']);


Route::get('/product', [AddProduct::class, 'product']);
Route::get('/create_product', [AddProduct::class, 'create_product']);
Route::get('/add_product', [AddProduct::class, 'add_product']);
Route::get('/create_inventory_product/{id}', [AddProduct::class, 'create_inventory_product']);
Route::get('/add_inventory_product', [AddProduct::class, 'add_inventory_product']);
Route::get('/show_box', [AddProduct::class, 'show_box']);
Route::post('update_qty', [AddProduct::class, 'update_qty']);
Route::get('get_product', [AjaxController::class, 'get_product']);
Route::get('update_qty_ajax', [AjaxController::class, 'update_qty_ajax']);
Route::post('move_product', [AddProduct::class, 'move_product']);
Route::get('remove_inventory_product', [AddProduct::class, 'remove_inventory_product']);
Route::get('edit_product', [AjaxController::class, 'edit_product']);
Route::post('/update_product/{id}', [AddProduct::class, 'update_product']);
Route::get('get_cat', [AjaxController::class, 'get_cat']);
Route::get('product_image_remove', [AjaxController::class, 'product_image_remove']);
Route::post('/new_add_product', [AddProduct::class, 'new_add_product']);

Route::get('/add_new_product', [AddProduct::class, 'add_new_product']);


Route::get('edit_new_product', [AjaxController::class, 'edit_new_product']);
Route::post('/export_product', [AddProduct::class, 'export_product']);
Route::get('/check_product_box', [AjaxController::class, 'check_product_box']);
Route::get('/filter_product', [AjaxController::class, 'filter_product']);
Route::get('/filter_product_wharehouse', [AjaxController::class, 'filter_product_wharehouse']);
Route::post('/import_product', [Import::class, 'import_product']);
Route::post('/import_product_chainable', [Import::class, 'import_product_chainable']);
Route::get('/search_global_product', [AjaxController::class, 'search_global_product']);
Route::get('/update_cost', [AjaxController::class, 'update_cost']);
Route::get('/update_price', [AjaxController::class, 'update_price']);


Route::get('/active_product', [Import::class, 'active_product']);













Route::get('/get_level', [AjaxController::class, 'get_level']);
Route::get('/get_bins', [AjaxController::class, 'get_bins']);
Route::get('/get_row', [AjaxController::class, 'get_row']);
Route::get('/check_box', [AjaxController::class, 'check_box']);
Route::get('/check_update_box', [AjaxController::class, 'check_update_box']);
Route::get('/get_inventory', [AjaxController::class, 'get_inventory']);
Route::get('/search_product', [AjaxController::class, 'search_product']);
// 
Route::get('/update_old_product', [AjaxController::class, 'update_old_product']);
// 
Route::post('/import', [AjaxController::class, 'import']);
Route::get('/import_view', [AjaxController::class, 'import_view']);




  Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
