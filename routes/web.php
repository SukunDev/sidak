<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\Alat\AlatController as UserAlatController;
use App\Http\Controllers\Admin\Alat\AlatController as AdminAlatController;
use App\Http\Controllers\Admin\Users\UsersController as AdminUsersController;
use App\Http\Controllers\User\Settings\SettingsController as UserSettingsController;
use App\Http\Controllers\Admin\Settings\SettingsController as AdminSettingsController;
use App\Http\Controllers\User\Dashboard\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\Dashboard\DashboardController as AdminDashboardController;

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
// Auth
Route::get('/auth/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/auth/login', [AuthController::class, 'postLogin']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Admin
Route::group(
    ['prefix' => 'admin', 'middleware' => ['admin', 'auth']],
    function () {
        Route::get('/', [AdminDashboardController::class, 'index']);
        Route::group(['prefix' => 'alat'], function () {
            Route::get('/', [AdminAlatController::class, 'index']);
            Route::get('/new', [AdminAlatController::class, 'newIndex']);
            Route::post('/new', [AdminAlatController::class, 'newPost']);
            Route::group(['prefix' => 'detail/{alat:id}'], function () {
                Route::get('/', [AdminAlatController::class, 'detailIndex']);
                Route::post('/tambah-jadwal', [
                    AdminAlatController::class,
                    'tambahJadwal',
                ]);
                Route::get('/hapus-jadwal', [
                    AdminAlatController::class,
                    'hapusJadwal',
                ]);
                Route::post('/sudah-terkalibrasi', [
                    AdminAlatController::class,
                    'sudahTerkalibrasi',
                ]);
                Route::post('/upload-sertifikat', [
                    AdminAlatController::class,
                    'uploadSertifikat',
                ]);
                Route::get('/hapus-sertifikat/{item_id}', [
                    AdminAlatController::class,
                    'hapusSertifikat',
                ]);
                Route::get('/hapus-keberterimaan/{item_id}', [
                    AdminAlatController::class,
                    'hapusKeberterimaan',
                ]);
            });
            Route::get('/edit/{alat:id}', [
                AdminAlatController::class,
                'editIndex',
            ]);
            Route::post('/edit/{alat:id}', [
                AdminAlatController::class,
                'editPost',
            ]);
            Route::get('/hapus/{id}', [AdminAlatController::class, 'hapus']);
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AdminUsersController::class, 'index']);
            Route::post('/tambah-user', [
                AdminUsersController::class,
                'newUser',
            ]);
            Route::get('/inactive', [
                AdminUsersController::class,
                'userInActive',
            ]);
            Route::get('/{user:username}', [
                AdminUsersController::class,
                'userDetail',
            ]);
            Route::post('/{user:username}/status', [
                AdminUsersController::class,
                'statusUser',
            ]);
            Route::get('/{id}/hapus', [
                AdminUsersController::class,
                'hapusUser',
            ]);
        });
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [AdminSettingsController::class, 'index']);
            Route::post('/', [AdminSettingsController::class, 'settings']);
        });
    }
);

// User
Route::group(
    ['prefix' => 'dashboard', 'middleware' => ['user', 'auth']],
    function () {
        Route::get('/', [UserDashboardController::class, 'index']);
        Route::group(['prefix' => 'alat'], function () {
            Route::get('/', [UserAlatController::class, 'index']);
            Route::group(['prefix' => 'detail/{alat:id}'], function () {
                Route::get('/', [UserAlatController::class, 'detailIndex']);
            });
        });
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [UserSettingsController::class, 'index']);
            Route::post('/', [UserSettingsController::class, 'settings']);
        });
    }
);
