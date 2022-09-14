<?php

use App\Http\Controllers\DataMasterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;

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
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    //Produk
    Route::get('/produk', [DataMasterController::class, 'index']);
    Route::post('/list_produk', [DataMasterController::class, 'list']);
    Route::post('/tambah_produk', [DataMasterController::class, 'tambah']);
    Route::post('/edit_produk', [DataMasterController::class, 'edit']);
    Route::post('/delete_produk', [DataMasterController::class, 'hapus']);

    //Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/list_transaksi', [TransaksiController::class, 'list']);
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
