<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'index']);

Route::get('/ajax_gt_jadwal', [HomeController::class, 'ajax_gt_all_tb_jadwal']);

Route::post('/prosesJadwal', [HomeController::class, 'ajax_proses_jadwal']);

Route::post('/prosesHapusJadwal', [HomeController::class, 'ajax_proses_hapus_jadwal']);
