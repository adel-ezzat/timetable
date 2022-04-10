<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\DashboardController;
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

Auth::routes([
'register' => false,
'reset' => false, 
'verify' => false, 
]);

//home route
Route::get('/', function () {
    return view('auth.login');
});


// dashboard routes
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', DashboardController::class)->name('index');
});

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminController::class, 'update'])->name('update');
        Route::post('/destroy', [AdminController::class, 'destroy'])->name('destroy');
    });
});

// user routes
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');
});

// roles & permissions routes
Route::group(['prefix' => 'role', 'as' => 'role.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/update', [RoleController::class, 'update'])->name('update');
    Route::post('/destroy', [RoleController::class, 'destroy'])->name('destroy');
});

// pharmacies routes
Route::group(['prefix' => 'pharmacy', 'as' => 'pharmacy.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [PharmacyController::class, 'index'])->name('index');
    Route::get('/create', [PharmacyController::class, 'create'])->name('create');
    Route::post('/store', [PharmacyController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PharmacyController::class, 'edit'])->name('edit');
    Route::post('/update', [PharmacyController::class, 'update'])->name('update');
    Route::post('/destroy', [PharmacyController::class, 'destroy'])->name('destroy');
});

// timetable routes
Route::group(['prefix' => 'timetable', 'as' => 'timetable.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [TimetableController::class, 'index'])->name('index');
    Route::post('/store', [TimetableController::class, 'store'])->name('store');
    Route::post('/generate-dates-range', [TimetableController::class, 'getDatesRange'])->name('generate-dates-range');
    Route::post('/generate-time-table', [TimetableController::class, 'generateTimeTable'])->name('generate-time-table');
});

// user timetable home routes
Route::group(['prefix' => 'home', 'as' => 'home.', 'middleware' => 'auth:web'], function () {
    Route::get('/', [TimetableController::class, 'userHome'])->name('index');
    Route::post('/generate-dates-range', [TimetableController::class, 'getDatesRange'])->name('generate-dates-range');
    Route::post('/generate-time-table', [TimetableController::class, 'generateTimeTable'])->name('generate-time-table');
});


