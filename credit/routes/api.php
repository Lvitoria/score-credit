<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\creditController;
use App\Http\Controllers\authController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[authController::class, 'login']);
Route::post('/store',[authController::class, 'store']);

Route::get('/test', function () {
    return response('Test API', 201)
                  ->header('Content-Type', 'application/json');
});

Route::prefix('/credit')->group(function(){
    Route::post('/',[creditController::class, 'store']);
    Route::get('/baseA/{cpf}',[creditController::class, 'baseA'])->middleware('auth.token');
    Route::get('/baseB/{cpf}',[creditController::class, 'baseB'])->middleware('auth.token');
    Route::get('/baseC/{cpf}',[creditController::class, 'baseC']);
});
