<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NisanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackupController;

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
    return view('layouts.welcome');
});

// Auth::routes();
Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/backup', [BackupController::class, 'index'])->name('backup');
    Route::get('/backup/create', [BackupController::class, 'create'])->name('backup.create');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/add', [UserController::class, 'add']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/change', [UserController::class, 'change']);
    Route::get('/user/reset', [UserController::class, 'reset']);
    Route::get('/user/change/{id}', [UserController::class, 'showchange']);
    Route::get('/user/reset/{id}', [UserController::class, 'showreset']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

    Route::get('/nisan', [NisanController::class, 'index'])->name('nisan');
    Route::get('/nisan/show/{id}', [NisanController::class, 'show'])->name('nisan.show');
    Route::get('/nisan/edit/{id}', [NisanController::class, 'edit'])->name('nisan.edit');
    Route::get('/nisan/create', [NisanController::class, 'create'])->name('nisan.create');
    Route::post('/nisan/store', [NisanController::class, 'store'])->name('nisan.store');
    Route::post('/nisan/update/{id}', [NisanController::class, 'update'])->name('nisan.update');
    Route::get('/nisan/destroy/{id}', [NisanController::class, 'destroy'])->name('nisan.destroy');
    Route::post('/nisan/filter/name', [NisanController::class, 'filter_name'])->name('nisan.filter_name');
    Route::post('/nisan/filter/year', [NisanController::class, 'filter_year'])->name('nisan.filter_year');

    Route::get('api/nisan', [NisanController::class, 'api'])->name('api.nisan');
});
