<?php

use App\Http\Controllers\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Product
Route::get('/products', [ProductApiController::class, 'index']); //mendapatkan semua informasi produk
Route::post('/products', [ProductApiController::class, 'store']); //memasukkan data produk ke api
Route::get('/products/{id}/', [ProductApiController::class, 'show']); //menampilkan data produk sesuai dengan id produk
Route::put('/products/{id}', [ProductApiController::class, 'update']); //mengupdate data produk sesuai dengan id produk 
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']); //menghapus data produk sesuai dengan id produk