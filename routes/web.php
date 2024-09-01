<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('committees',\App\Http\Controllers\CommitteeController::class);
Route::resource('positions',\App\Http\Controllers\PositionController::class);
Route::group(['controller'=>\App\Http\Controllers\MembersController::class, 'prefix'=>'members', 'as'=>'members.'],function(){
    Route::get('export','export')->name('export');
    Route::post('import','import')->name('import');
});
Route::resource('members',\App\Http\Controllers\MembersController::class);
