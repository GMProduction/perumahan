<?php


use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/')->middleware('auth')->group(function (){
    Route::get('', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin', function () {
        return view('admin');
    });


    Route::match(['POST','GET'],'/user', [\App\Http\Controllers\Admin\UserController::class,'index']);

    Route::match(['POST','GET'],'/pembelian', [PesananController::class,'index']);

    Route::prefix('/perkembangan')->group(function (){
        Route::get('/', [\App\Http\Controllers\Admin\PerkembanganController::class, 'index']);
        Route::match(['POST','GET'],'/{id}', [\App\Http\Controllers\Admin\PerkembanganController::class, 'detail']);
        Route::match(['POST','GET'],'/{id}/detail/{detail}/image', [\App\Http\Controllers\Admin\PerkembanganController::class, 'image'])->name('perkembanganImage');
    });
});





Route::match(['GET','POST'],'/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('login');
