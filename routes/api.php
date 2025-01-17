<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login',[UserAuthController::class,'login']);

Route::post('register/medic',[MedicController::class,'create']);

Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');


  Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(SpecialtyController::class)->group(function () {
      Route::prefix('specialty')->group(function(){
        Route::get('/', 'index');
        Route::get('/{specialtyID}', 'indexById');
        Route::post('/', 'store');
        Route::put('/{specialtyID}', 'update');
        Route::delete('/{specialtyID}', 'delete');
      });
    });

    Route::controller(ServiceController::class)->group(function () {
      Route::prefix('service')->group(function(){
        Route::get('/', 'index');
        Route::get('/{serviceID}', 'indexById');
        Route::get('/specialty/{specialtyID}', 'indexByspecialtyId');
        Route::post('/', 'store');
        Route::put('/{serviceID}', 'update');
        Route::delete('/{serviceID}', 'delete');
      });
    });

    Route::controller(LocationController::class)->group(function () {
      Route::prefix('location')->group(function(){
        Route::get('/', 'index');
        Route::get('/{locationID}', 'indexById');
        Route::post('/', 'store');
        Route::put('/{locationID}', 'update');
        Route::delete('/{locationID}', 'delete');
      });
    });

    Route::controller(MedicController::class)->group(function () {
      Route::prefix('medic')->group(function(){
        Route::get('/', 'index');
        Route::get('/csv', 'getMedicsCSV');
        Route::get('/{medicID}', 'indexById');
        Route::get('/specialty/{specialtyID}', 'indexBySpecialty');
        Route::get('/user/{userID}', 'indexByUserId');
        Route::post('/', 'store');
        Route::get('/service/{medic_id}', 'indexMedicServiceByMedicId');
        Route::post('/service', 'addService');
        Route::put('/{medicID}', 'update');
        Route::delete('/{medicID}', 'delete');
      });
    });

    
  });

Route::get('/test', function (Request $request) {
    return "hello world";
});