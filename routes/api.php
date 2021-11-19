<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\ProfileController;
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

Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::prefix('profile')->group(function (){
        Route::match(['POST','GET'],'/' ,[ProfileController::class, 'index']);
    });
    Route::get('/pesanan',[PesananController::class,'index']);
    Route::get('/pesanan/{id}',[PesananController::class,'perkembangan']);
    Route::get('/pesanan/{id}/detail/{d}',[PesananController::class,'perkembanganDetail']);
});
