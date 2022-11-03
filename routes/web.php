<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Alat\AlatController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;

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
    return redirect('/auth/login');
});

Route::get('/auth/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/auth/login', [AuthController::class, 'postLogin']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/settings', [SettingsController::class, 'index']);
        Route::post('/settings', [SettingsController::class, 'settings']);
        Route::get('/alat', [AlatController::class, 'index']);
        Route::get('/alat/tambah', [AlatController::class, 'tambah']);
        Route::post('/alat/tambah', [AlatController::class, 'tambahPost']);
        Route::get('/alat/{detail:id}', [AlatController::class, 'detail']);
        Route::get('/alat/{detail:id}/edit', [AlatController::class, 'edit']);
        Route::post('/alat/{detail:id}/edit', [
            AlatController::class,
            'editPost',
        ]);
        Route::post('/alat/{detail:id}/tambah-jadwal', [
            AlatController::class,
            'tambahJadwal',
        ]);
        Route::get('/alat/{detail:id}/hapus-jadwal', [
            AlatController::class,
            'hapusJadwal',
        ]);
        Route::get('/alat/{detail:id}/hapus-sertifikat/{sertifikat_id}', [
            AlatController::class,
            'hapusSertifikat',
        ]);
        Route::post('/alat/{detail:id}/upload-sertifikat', [
            AlatController::class,
            'uploadSertifikat',
        ]);
        Route::post('/alat/{detail:id}/sudah-terkalibrasi', [
            AlatController::class,
            'sudahTerkalibrasi',
        ]);
        Route::get('/alat/hapus/{id}', [AlatController::class, 'hapus']);

        // Admin Page
        Route::prefix('admin')->group(function () {
            Route::get('/user', [AdminController::class, 'index']);
            Route::get('/user/inactive', [
                AdminController::class,
                'userInActive',
            ]);
            Route::get('/user/{user_detail:id}', [
                AdminController::class,
                'userDetail',
            ]);
            Route::post('/user/tambah-user', [
                AdminController::class,
                'tambahUser',
            ]);
            Route::post('/user/{id}/status', [
                AdminController::class,
                'statusUser',
            ]);
        });
    });
