<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\IndexController;

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

Route::get('/', function () {
    return view('welcome');
});
//need admin permission
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dev', [IndexController::class, 'index']);
});
