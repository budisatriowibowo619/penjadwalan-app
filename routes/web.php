<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);

// -- Page -- // 
Route::get('/home', [HomeController::class, 'index']);
// -- End Page -- //

// -- Ajax -- //
# GET #
Route::get('/gtCalendarPenjadwalan', [HomeController::class, 'ajax_gt_all_tb_jadwal']);
Route::get('/gtPenjadwalan', [HomeController::class, 'ajax_gt_penjadwalan']);
Route::get('/selectRoom', [MasterController::class, 'ajax_select_room']);
# END GET #

# POST #
Route::post('/processLogin', [LoginController::class, 'ajax_process_login']);
Route::post('/processJadwal', [HomeController::class, 'ajax_process_jadwal']);
Route::post('/deleteJadwal', [HomeController::class, 'ajax_delete_jadwal']);
# END POST #
// - End Ajax -- //

# Insert #
Route::get('/insert', [HomeController::class, 'insert_user']);
# End Insert #