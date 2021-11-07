<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\TransportController;
use App\Models\Transport;
use App\Models\Truck;
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
    return redirect('transports');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'trucks'], function(){
    Route::get('', [TruckController::class, 'index'])->name('truck.index');
    Route::get('create', [TruckController::class, 'create'])->name('truck.create');
    Route::post('store', [TruckController::class, 'store'])->name('truck.store');
    Route::get('edit/{truck}', [TruckController::class, 'edit'])->name('truck.edit');
    Route::post('update/{truck}', [TruckController::class, 'update'])->name('truck.update');
    Route::post('delete/{truck}', [TruckController::class, 'destroy'])->name('truck.destroy');
    Route::get('show/{truck}', [TruckController::class, 'show'])->name('truck.show');
 });
 

 Route::group(['prefix' => 'transports'], function(){
    Route::get('', [TransportController::class, 'index'])->name('transport.index');
    Route::get('create', [TransportController::class, 'create'])->name('transport.create');
    Route::post('store', [TransportController::class, 'store'])->name('transport.store');
    Route::get('edit/{transport}', [TransportController::class, 'edit'])->name('transport.edit');
    Route::post('update/{transport}', [TransportController::class, 'update'])->name('transport.update');
    Route::post('delete/{transport}', [TransportController::class, 'destroy'])->name('transport.destroy');
    Route::get('show/{transport}', [TransportController::class, 'show'])->name('transport.show');
 });
